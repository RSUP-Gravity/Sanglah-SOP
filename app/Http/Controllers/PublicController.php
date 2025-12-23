<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use App\Models\Direktorat;
use App\Models\Unit;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    /**
     * Display the public landing page with SOPs.
     */
    public function index(Request $request)
    {
        $query = Sop::with(['unit.direktorat', 'creator'])
            ->where('status', 'approved');

        // Filter by direktorat
        if ($request->filled('direktorat_id')) {
            $query->whereHas('unit', function($q) use ($request) {
                $q->where('direktorat_id', $request->direktorat_id);
            });
        }

        // Filter by unit
        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->unit_id);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('sk_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('unit', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('unit.direktorat', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $sops = $query->latest()->paginate(12);
        $direktorats = Direktorat::where('is_active', true)->get();
        $units = Unit::where('is_active', true)->get();

        // Get units for selected direktorat (for AJAX)
        $selectedUnits = [];
        if ($request->filled('direktorat_id')) {
            $selectedUnits = Unit::where('direktorat_id', $request->direktorat_id)
                ->where('is_active', true)
                ->get();
        }

        return view('public.index', compact('sops', 'direktorats', 'units', 'selectedUnits'));
    }

    /**
     * Get units by direktorat ID (API endpoint).
     */
    public function getUnitsByDirektorat($direktoratId)
    {
        $units = Unit::where('direktorat_id', $direktoratId)
            ->where('is_active', true)
            ->select('id', 'name', 'code')
            ->orderBy('name')
            ->get();

        return response()->json($units);
    }

    /**
     * Display a specific SOP detail for public view.
     */
    public function showSop($id)
    {
        $sop = Sop::with(['unit.direktorat', 'creator', 'versions'])
            ->where('status', 'approved')
            ->findOrFail($id);

        return view('public.sop-detail', compact('sop'));
    }

    /**
     * Download SOP file for public (approved SOPs only)
     */
    public function downloadSop($id)
    {
        $sop = Sop::where('status', 'approved')->findOrFail($id);

        // Check if file exists
        if (!$sop->file_path || !Storage::disk('local')->exists($sop->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Log download activity (without user_id for public)
        ActivityLog::create([
            'user_id' => null,
            'subject_type' => Sop::class,
            'subject_id' => $sop->id,
            'action' => 'public_downloaded',
            'description' => 'Unduhan publik SOP: ' . $sop->title,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Return file download
        return Storage::disk('local')->download($sop->file_path, $sop->file_name);
    }

    /**
     * View SOP file inline for public
     */
    public function viewSop($id)
    {
        $sop = Sop::where('status', 'approved')->findOrFail($id);

        // Check if file exists
        if (!$sop->file_path || !Storage::disk('local')->exists($sop->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Return file as inline for viewing
        return response()->file(Storage::disk('local')->path($sop->file_path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $sop->file_name . '"'
        ]);
    }
}
