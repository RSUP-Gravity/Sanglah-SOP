<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use App\Models\Unit;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sop::with(['unit', 'creator']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Unit filter
        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->unit_id);
        }

        // Role-based filtering
        $user = Auth::user();
        if ($user->isUser()) {
            // Regular users only see their own SOPs
            $query->where('created_by', $user->id);
        } elseif ($user->isValidator()) {
            // Validators see SOPs from their unit or all pending validations
            $query->where(function($q) use ($user) {
                $q->where('unit_id', $user->unit_id)
                  ->orWhere('status', 'pending_validation');
            });
        }
        // Super Admin sees all SOPs

        $sops = $query->latest()->paginate(15);

        return view('sops.index', compact('sops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        return view('sops.create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sops,code',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'effective_date' => 'required|date',
            'review_date' => 'required|date|after:effective_date',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug($validated['title']) . '.pdf';
            $filePath = $file->storeAs('sops', $fileName, 'local');

            $validated['file_path'] = $filePath;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_size'] = $file->getSize();
        }

        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();
        $validated['status'] = 'draft';
        $validated['version'] = '1.0';

        $sop = Sop::create($validated);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => Sop::class,
            'subject_id' => $sop->id,
            'action' => 'created',
            'description' => 'Membuat SOP baru: ' . $sop->title,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('sops.show', $sop)
            ->with('success', 'SOP berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sop $sop)
    {
        $sop->load(['unit', 'creator', 'updater', 'versions', 'validations.validator']);

        return view('sops.show', compact('sop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sop $sop)
    {
        // Check authorization
        if (!Auth::user()->isSuperAdmin() && $sop->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $units = Unit::all();
        return view('sops.edit', compact('sop', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sop $sop)
    {
        // Check authorization
        if (!Auth::user()->isSuperAdmin() && $sop->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sops,code,' . $sop->id,
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'effective_date' => 'required|date',
            'review_date' => 'required|date|after:effective_date',
        ]);

        // Handle file upload if new file provided
        if ($request->hasFile('file')) {
            // Delete old file
            if ($sop->file_path) {
                Storage::disk('local')->delete($sop->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug($validated['title']) . '.pdf';
            $filePath = $file->storeAs('sops', $fileName, 'local');

            $validated['file_path'] = $filePath;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_size'] = $file->getSize();
        }

        $validated['updated_by'] = Auth::id();

        $oldValues = $sop->toArray();
        $sop->update($validated);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => Sop::class,
            'subject_id' => $sop->id,
            'action' => 'updated',
            'description' => 'Mengupdate SOP: ' . $sop->title,
            'old_values' => $oldValues,
            'new_values' => $sop->fresh()->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('sops.show', $sop)
            ->with('success', 'SOP berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sop $sop)
    {
        // Check authorization
        if (!Auth::user()->isSuperAdmin() && $sop->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Don't delete file - keep it for history
        // Only soft delete the record

        // Log activity before deletion
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => Sop::class,
            'subject_id' => $sop->id,
            'action' => 'deleted',
            'description' => 'Menghapus SOP: ' . $sop->title,
            'old_values' => $sop->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $sop->delete();

        return redirect()->route('sops.index')
            ->with('success', 'SOP berhasil dihapus!');
    }

    /**
     * Display a listing of trashed SOPs.
     */
    public function trash(Request $request)
    {
        $query = Sop::onlyTrashed()->with(['unit', 'creator']);

        // Filter by user's own SOPs if not admin
        if (!Auth::user()->isSuperAdmin() && !Auth::user()->isValidator()) {
            $query->where('created_by', Auth::id());
        }

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $sops = $query->latest('deleted_at')->paginate(15);

        return view('sops.trash', compact('sops'));
    }

    /**
     * Restore a trashed SOP.
     */
    public function restore($id)
    {
        $sop = Sop::onlyTrashed()->findOrFail($id);

        // Check authorization
        if (!Auth::user()->isSuperAdmin() && $sop->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $sop->restore();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => Sop::class,
            'subject_id' => $sop->id,
            'action' => 'restored',
            'description' => 'Memulihkan SOP: ' . $sop->title,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->back()
            ->with('success', 'SOP berhasil dipulihkan!');
    }

    /**
     * Permanently delete a trashed SOP.
     */
    public function forceDelete($id)
    {
        // Only super admin can permanently delete
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $sop = Sop::onlyTrashed()->findOrFail($id);

        // Delete file permanently
        if ($sop->file_path) {
            Storage::disk('local')->delete($sop->file_path);
        }

        // Log activity before permanent deletion
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => Sop::class,
            'subject_id' => $sop->id,
            'action' => 'force_deleted',
            'description' => 'Menghapus permanen SOP: ' . $sop->title,
            'old_values' => $sop->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $sop->forceDelete();

        return redirect()->back()
            ->with('success', 'SOP berhasil dihapus permanen!');
    }

    /**
     * Download SOP file with authorization check
     */
    public function download(Sop $sop)
    {
        // Check if user has permission to download
        $user = Auth::user();
        
        // Allow if:
        // 1. Super Admin
        // 2. Validator from same unit
        // 3. Creator of the SOP
        // 4. SOP is approved (public)
        if (!$user->isSuperAdmin() && 
            !($user->isValidator() && $user->unit_id === $sop->unit_id) &&
            $sop->created_by !== $user->id &&
            $sop->status !== 'approved') {
            abort(403, 'Anda tidak memiliki akses untuk mengunduh file ini.');
        }

        // Check if file exists
        if (!$sop->file_path || !Storage::disk('local')->exists($sop->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Log download activity
        ActivityLog::create([
            'user_id' => $user->id,
            'subject_type' => Sop::class,
            'subject_id' => $sop->id,
            'action' => 'downloaded',
            'description' => 'Mengunduh SOP: ' . $sop->title,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Return file download
        return Storage::disk('local')->download($sop->file_path, $sop->file_name);
    }

    /**
     * View/Stream SOP file inline (for PDF preview)
     */
    public function view(Sop $sop)
    {
        // Check if user has permission to view
        $user = Auth::user();
        
        if (!$user->isSuperAdmin() && 
            !($user->isValidator() && $user->unit_id === $sop->unit_id) &&
            $sop->created_by !== $user->id &&
            $sop->status !== 'approved') {
            abort(403, 'Anda tidak memiliki akses untuk melihat file ini.');
        }

        // Check if file exists
        if (!$sop->file_path || !Storage::disk('local')->exists($sop->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Return file as inline (for viewing in browser)
        return response()->file(Storage::disk('local')->path($sop->file_path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $sop->file_name . '"'
        ]);
    }
}
