<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Unit;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $query = User::with(['role', 'unit']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        // Unit filter
        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->unit_id);
        }

        // Status filter
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $users = $query->latest()->paginate(15);
        $roles = Role::all();
        $units = Unit::all();

        return view('users.index', compact('users', 'roles', 'units'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::all();
        $units = Unit::all();

        return view('users.create', compact('roles', 'units'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nip' => 'required|string|max:50|unique:users',
            'role_id' => 'required|exists:roles,id',
            'unit_id' => 'nullable|exists:units,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_active' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $user = User::create($validated);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'action' => 'created',
            'description' => 'Membuat pengguna baru: ' . $user->name,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dibuat!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $user->load(['role', 'unit', 'sops', 'validations', 'activities']);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::all();
        $units = Unit::all();

        return view('users.edit', compact('user', 'roles', 'units'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nip' => 'required|string|max:50|unique:users,nip,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'unit_id' => 'nullable|exists:units,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'is_active' => 'boolean',
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;

        $oldValues = $user->toArray();
        $user->update($validated);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'action' => 'updated',
            'description' => 'Mengupdate pengguna: ' . $user->name,
            'old_values' => $oldValues,
            'new_values' => $user->fresh()->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil diupdate!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Prevent deleting self
        if ($user->id === Auth::id()) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        // Log activity before deletion
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'action' => 'deleted',
            'description' => 'Menghapus pengguna: ' . $user->name,
            'old_values' => $user->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus!');
    }

    /**
     * Toggle user active status.
     */
    public function toggleStatus(User $user)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Prevent deactivating self
        if ($user->id === Auth::id()) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri!');
        }

        $user->update(['is_active' => !$user->is_active]);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'action' => $user->is_active ? 'activated' : 'deactivated',
            'description' => ($user->is_active ? 'Mengaktifkan' : 'Menonaktifkan') . ' pengguna: ' . $user->name,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->back()
            ->with('success', 'Status pengguna berhasil diubah!');
    }

    /**
     * Display a listing of trashed users.
     */
    public function trash(Request $request)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $query = User::onlyTrashed()->with(['role', 'unit']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $users = $query->latest('deleted_at')->paginate(15);

        return view('users.trash', compact('users'));
    }

    /**
     * Restore a trashed user.
     */
    public function restore($id)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'action' => 'restored',
            'description' => 'Memulihkan pengguna: ' . $user->name,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->back()
            ->with('success', 'Pengguna berhasil dipulihkan!');
    }

    /**
     * Permanently delete a trashed user.
     */
    public function forceDelete($id)
    {
        // Only super admin can access
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::onlyTrashed()->findOrFail($id);

        // Log activity before permanent deletion
        ActivityLog::create([
            'user_id' => Auth::id(),
            'subject_type' => User::class,
            'subject_id' => $user->id,
            'action' => 'force_deleted',
            'description' => 'Menghapus permanen pengguna: ' . $user->name,
            'old_values' => $user->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $user->forceDelete();

        return redirect()->back()
            ->with('success', 'Pengguna berhasil dihapus permanen!');
    }
}
