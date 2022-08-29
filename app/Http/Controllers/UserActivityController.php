<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class UserActivityController extends Controller
{
    public function show(Request $request) {
        return view('profile.activity', ['title' => __('Security logs'),
            'sessionsActivities' => Activity::where('log_name', 'sessions_log')
                ->where('subject_id', $request->user()->id)
                ->orderBy('created_at', 'DESC')
                ->limit(10)
                ->get(),
            'userUpdateActivities' => Activity::where('log_name', 'user_updates_log')
                ->where('subject_id', $request->user()->id)
                ->orderBy('created_at', 'DESC')
                ->limit(10)
                ->get()]);
    }
}
