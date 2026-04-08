<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    /**
     * Log a user activity
     *
     * @param string $type (Login, Logout, Create, Update, Delete, Validation, etc.)
     * @param string $description
     * @param int|null $userId
     * @return void
     */
    public static function log($type, $description, $userId = null)
    {
        ActivityLog::create([
            'user_id' => $userId ?? auth()->id(),
            'activity_type' => $type,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
