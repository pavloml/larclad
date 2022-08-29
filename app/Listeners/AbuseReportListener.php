<?php

namespace App\Listeners;

use App\Events\NewAbuseReport;
use App\Models\User;
use App\Notifications\NewAbuseReportNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AbuseReportListener
{
    /**
     * IP address
     *
     * @var string
     */
    public string $ip;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->ip = $request->ip();
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewAbuseReport  $event
     * @return void
     */
    public function handle(NewAbuseReport $event)
    {
        activity('abuse_reports_log')
            ->on($event->complain)
            ->withProperties(['FromIP' => $this->ip])
            ->log('New Abuse Report');

        $admins = User::role('admin')->get();

        Notification::send($admins, new NewAbuseReportNotification($event->post, $event->complain->reason));
    }
}
