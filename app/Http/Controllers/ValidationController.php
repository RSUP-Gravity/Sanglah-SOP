<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use App\Models\Validation;
use App\Models\Notification;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ValidationController extends Controller
{
    /**
     * Display a listing of validations.
     */
    public function index(Request $request)
    {
        // Only validators and super admin can access
        if (!Auth::user()->isValidator() && !Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $query = Validation::with(['sop.unit', 'sop.creator', 'validator']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by SOP
        if ($request->filled('sop_id')) {
            $query->where('sop_id', $request->sop_id);
        }

        // If validator (not super admin), show only their unit's validations or assigned to them
        if (Auth::user()->isValidator() && !Auth::user()->isSuperAdmin()) {
            $query->where(function($q) {
                $q->where('validator_id', Auth::id())
                  ->orWhereHas('sop', function($sopQuery) {
                      $sopQuery->where('unit_id', Auth::user()->unit_id);
                  });
            });
        }

        $validations = $query->latest()->paginate(15);

        // Get pending SOPs that need validation
        $pendingSops = Sop::where('status', 'pending_validation')
            ->with(['unit', 'creator'])
            ->when(!Auth::user()->isSuperAdmin(), function($q) {
                return $q->where('unit_id', Auth::user()->unit_id);
            })
            ->latest()
            ->get();

        return view('validations.index', compact('validations', 'pendingSops'));
    }

    /**
     * Show the form for creating a new validation request.
     */
    public function create($sopId)
    {
        $sop = Sop::with(['unit', 'creator'])->findOrFail($sopId);

        // Check if user is creator or super admin
        if (!Auth::user()->isSuperAdmin() && $sop->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if SOP is in draft status
        if ($sop->status !== 'draft') {
            return redirect()->route('sops.show', $sop)
                ->with('error', 'Hanya SOP dengan status draft yang dapat diajukan untuk validasi.');
        }

        return view('validations.create', compact('sop'));
    }

    /**
     * Submit SOP for validation.
     */
    public function store(Request $request, $sopId)
    {
        $sop = Sop::findOrFail($sopId);

        // Check if user is creator or super admin
        if (!Auth::user()->isSuperAdmin() && $sop->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if SOP is in draft status
        if ($sop->status !== 'draft') {
            return redirect()->route('sops.show', $sop)
                ->with('error', 'Hanya SOP dengan status draft yang dapat diajukan untuk validasi.');
        }

        $validated = $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            // Update SOP status
            $sop->update(['status' => 'pending_validation']);

            // Create validation record
            $validation = Validation::create([
                'sop_id' => $sop->id,
                'validator_id' => null, // Will be assigned by admin or auto-assigned
                'status' => 'pending',
                'notes' => $validated['notes'] ?? 'Pengajuan validasi SOP',
            ]);

            // Find validators in the same unit
            $validators = \App\Models\User::where('role_id', 2) // role_id 2 = validator
                ->where('unit_id', $sop->unit_id)
                ->where('is_active', true)
                ->get();

            // Create notifications for validators
            foreach ($validators as $validator) {
                Notification::create([
                    'user_id' => $validator->id,
                    'title' => 'Permintaan Validasi SOP Baru',
                    'message' => 'SOP "' . $sop->title . '" memerlukan validasi Anda.',
                    'type' => 'validation_request',
                    'data' => json_encode([
                        'sop_id' => $sop->id,
                        'validation_id' => $validation->id,
                        'creator' => Auth::user()->name,
                    ]),
                ]);
            }

            // Log activity
            ActivityLog::create([
                'user_id' => Auth::id(),
                'subject_type' => Sop::class,
                'subject_id' => $sop->id,
                'action' => 'submitted_for_validation',
                'description' => 'Mengajukan SOP untuk validasi: ' . $sop->title,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            DB::commit();

            return redirect()->route('sops.show', $sop)
                ->with('success', 'SOP berhasil diajukan untuk validasi!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show validation detail.
     */
    public function show($id)
    {
        $validation = Validation::with(['sop.unit', 'sop.creator', 'validator'])
            ->findOrFail($id);

        // Check authorization
        if (!Auth::user()->isSuperAdmin() 
            && !Auth::user()->isValidator() 
            && $validation->sop->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('validations.show', compact('validation'));
    }

    /**
     * Approve SOP validation.
     */
    public function approve(Request $request, $id)
    {
        $validation = Validation::with('sop')->findOrFail($id);

        // Only validators and super admin can approve
        if (!Auth::user()->isValidator() && !Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if already processed
        if ($validation->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Validasi ini sudah diproses sebelumnya.');
        }

        $validated = $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            // Update validation
            $validation->update([
                'validator_id' => Auth::id(),
                'status' => 'approved',
                'notes' => $validated['notes'] ?? 'SOP disetujui',
                'validated_at' => now(),
            ]);

            // Update SOP status to active
            $validation->sop->update(['status' => 'active']);

            // Create notification for SOP creator
            Notification::create([
                'user_id' => $validation->sop->created_by,
                'title' => 'SOP Disetujui',
                'message' => 'SOP "' . $validation->sop->title . '" telah disetujui oleh ' . Auth::user()->name,
                'type' => 'validation_approved',
                'data' => json_encode([
                    'sop_id' => $validation->sop->id,
                    'validation_id' => $validation->id,
                    'validator' => Auth::user()->name,
                ]),
            ]);

            // Log activity
            ActivityLog::create([
                'user_id' => Auth::id(),
                'subject_type' => Sop::class,
                'subject_id' => $validation->sop->id,
                'action' => 'approved',
                'description' => 'Menyetujui SOP: ' . $validation->sop->title,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            DB::commit();

            return redirect()->route('validations.index')
                ->with('success', 'SOP berhasil disetujui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Reject SOP validation.
     */
    public function reject(Request $request, $id)
    {
        $validation = Validation::with('sop')->findOrFail($id);

        // Only validators and super admin can reject
        if (!Auth::user()->isValidator() && !Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if already processed
        if ($validation->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Validasi ini sudah diproses sebelumnya.');
        }

        $validated = $request->validate([
            'notes' => 'required|string|max:500',
        ], [
            'notes.required' => 'Alasan penolakan harus diisi',
        ]);

        DB::beginTransaction();
        try {
            // Update validation
            $validation->update([
                'validator_id' => Auth::id(),
                'status' => 'rejected',
                'notes' => $validated['notes'],
                'validated_at' => now(),
            ]);

            // Update SOP status back to draft
            $validation->sop->update(['status' => 'draft']);

            // Create notification for SOP creator
            Notification::create([
                'user_id' => $validation->sop->created_by,
                'title' => 'SOP Ditolak',
                'message' => 'SOP "' . $validation->sop->title . '" ditolak oleh ' . Auth::user()->name,
                'type' => 'validation_rejected',
                'data' => json_encode([
                    'sop_id' => $validation->sop->id,
                    'validation_id' => $validation->id,
                    'validator' => Auth::user()->name,
                    'notes' => $validated['notes'],
                ]),
            ]);

            // Log activity
            ActivityLog::create([
                'user_id' => Auth::id(),
                'subject_type' => Sop::class,
                'subject_id' => $validation->sop->id,
                'action' => 'rejected',
                'description' => 'Menolak SOP: ' . $validation->sop->title,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            DB::commit();

            return redirect()->route('validations.index')
                ->with('success', 'SOP ditolak dan dikembalikan ke status draft.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
