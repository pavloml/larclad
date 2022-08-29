<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class AdminUserActivityController extends Controller
{
    public function __invoke($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response(['message' => 'Not Found'], 404);
        }

        return response(['sessionsActivities' => Activity::where('log_name', 'sessions_log')
                ->where('subject_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->get(),
            'userUpdateActivities' => Activity::where('log_name', 'user_updates_log')
                ->where('subject_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->get()]);
    }
}
