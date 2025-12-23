<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/sop/{id}', [PublicController::class, 'showSop'])->name('public.sop');
Route::get('/sop/{id}/download', [PublicController::class, 'downloadSop'])->name('public.sop.download');
Route::get('/sop/{id}/view', [PublicController::class, 'viewSop'])->name('public.sop.view');

// Documentation / Guides (Public)
Route::get('/panduan', [GuideController::class, 'list'])->name('guides.list');
Route::get('/panduan/{slug}', [GuideController::class, 'showPublic'])->name('guides.showPublic');

// API Routes for dynamic data
Route::get('/api/units-by-direktorat/{direktoratId}', [PublicController::class, 'getUnitsByDirektorat']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // SOP Routes
    Route::resource('sops', SopController::class);
    Route::get('/sops/{sop}/download', [SopController::class, 'download'])->name('sops.download');
    Route::get('/sops/{sop}/view', [SopController::class, 'view'])->name('sops.view');
    Route::get('/sops-trash', [SopController::class, 'trash'])->name('sops.trash');
    Route::post('/sops/{id}/restore', [SopController::class, 'restore'])->name('sops.restore');
    Route::delete('/sops/{id}/force-delete', [SopController::class, 'forceDelete'])->name('sops.force-delete');
    
    // Validation Routes
    Route::get('/validations', [ValidationController::class, 'index'])->name('validations.index');
    Route::get('/validations/create/{sop}', [ValidationController::class, 'create'])->name('validations.create');
    Route::post('/validations/{sop}', [ValidationController::class, 'store'])->name('validations.store');
    Route::get('/validations/{validation}', [ValidationController::class, 'show'])->name('validations.show');
    Route::post('/validations/{validation}/approve', [ValidationController::class, 'approve'])->name('validations.approve');
    Route::post('/validations/{validation}/reject', [ValidationController::class, 'reject'])->name('validations.reject');
    
    // User Management Routes (Admin only)
    Route::resource('users', UserController::class);
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::get('/users-trash', [UserController::class, 'trash'])->name('users.trash');
    Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');
    
    // Unit Management Route (Admin only)
    Route::resource('units', UnitController::class);
    
    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread', [NotificationController::class, 'unread'])->name('notifications.unread');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications/clear-read', [NotificationController::class, 'clearRead'])->name('notifications.clear-read');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // Guide Management
    Route::resource('guides', GuideController::class);
});

require __DIR__.'/auth.php';
