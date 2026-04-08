<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecurityController extends Controller
{
    /**
     * Display the security dashboard.
     */
    public function index()
    {
        abort_if(!auth()->user() || !in_array(auth()->user()->role, ['admin', 'superadmin']), 403);

        // Fetch recent activity logs
        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(20);

        // Security Status Data
        $securityStatus = [
            'sanctum' => class_exists(\Laravel\Sanctum\Sanctum::class),
            'headers' => class_exists(\App\Http\Middleware\SecurityHeaders::class),
            'rate_limiting' => true, // Assuming default Laravel setup
        ];

        // API Token count
        $activeTokens = DB::table('personal_access_tokens')->count();

        // Recent Login attempts (Last 24 hours)
        $recentLogins = ActivityLog::where('activity_type', 'like', '%Login%')
            ->where('created_at', '>=', now()->subDay())
            ->count();

        return view('admin.security.index', compact('logs', 'securityStatus', 'activeTokens', 'recentLogins'));
    }

    /**
     * Delete old logs (Cleanup)
     */
    public function destroyOldLogs()
    {
        // Keep only last 30 days
        ActivityLog::where('created_at', '<', now()->subDays(30))->delete();

        return redirect()->back()->with('success', 'Log lama berhasil dibersihkan.');
    }
}
