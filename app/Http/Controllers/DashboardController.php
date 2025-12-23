<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use App\Models\User;
use App\Models\Validation;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics
     */
    public function index()
    {
        $user = Auth::user();

        // 1. General Statistics
        $stats = [
            'total_sops' => Sop::count(),
            'active_sops' => Sop::active()->count(),
            'pending_validations' => Validation::pending()->count(),
            'active_users' => User::where('is_active', true)->count(),
            'total_units' => \App\Models\Unit::count(),
        ];

        // 2. Unit Statistics (Top 5 Units by SOP Count)
        $topUnits = \App\Models\Unit::withCount('sops')
            ->orderBy('sops_count', 'desc')
            ->take(5)
            ->get();

        // 3. Recent SOPs
        $recentSops = Sop::with(['unit', 'creator'])
            ->latest()
            ->take(5)
            ->get();

        // 4. Role-Specific Data
        $pendingValidations = collect();
        $mySopsStats = [];
        $validationStats = [];

        // Validator / Super Admin Data
        if ($user->isValidator() || $user->isSuperAdmin()) {
            $pendingValidations = Validation::with(['sop.unit', 'sop.creator'])
                ->pending()
                ->latest()
                ->take(5)
                ->get();
            
            if ($user->isValidator()) {
                $validationStats = [
                    'validated' => Validation::where('validator_id', $user->id)
                        ->whereIn('status', ['approved', 'rejected'])
                        ->count(),
                    'pending' => Validation::pending()->count(), // Assuming pool-based validation
                ];
            }
        }

        // User Data
        if ($user->isUser()) {
            $mySopsQuery = Sop::where('created_by', $user->id);
            $mySopsStats = [
                'total' => (clone $mySopsQuery)->count(),
                'draft' => (clone $mySopsQuery)->where('status', 'draft')->count(),
                'pending' => (clone $mySopsQuery)->where('status', 'pending_validation')->count(),
                'approved' => (clone $mySopsQuery)->where('status', 'approved')->count(),
                'rejected' => (clone $mySopsQuery)->where('status', 'rejected')->count(),
            ];
        }

        $mySops = collect();
        if ($user->isUser()) {
            $mySops = Sop::where('created_by', $user->id)
                ->with(['unit', 'latestValidation'])
                ->latest()
                ->take(5)
                ->get();
        }

        // 5. Activity Logs (Filtered by Role)
        $activityQuery = ActivityLog::with(['user', 'subject'])->latest();

        if ($user->isUser()) {
            // Regular users only see their own activities
            $activityQuery->where('user_id', $user->id);
        }
        
        $recentActivities = $activityQuery->take(10)->get();

        // 6. Chart Data
        $chartData = [
            'sopStatus' => [
                'labels' => ['Draft', 'Pending', 'Active', 'Rejected'],
                'data' => [
                    Sop::where('status', 'draft')->count(),
                    Sop::where('status', 'pending_validation')->count(),
                    Sop::where('status', 'approved')->count(),
                    Sop::where('status', 'rejected')->count(),
                ],
            ],
            'unitSops' => [
                'labels' => $topUnits->pluck('name')->map(function($name) {
                    return \Illuminate\Support\Str::limit($name, 15);
                })->toArray(),
                'data' => $topUnits->pluck('sops_count')->toArray(),
            ],
        ];

        return view('dashboard', compact(
            'stats',
            'topUnits',
            'recentSops',
            'pendingValidations',
            'recentActivities',
            'mySops',
            'mySopsStats',
            'validationStats',
            'chartData'
        ));
    }
}
