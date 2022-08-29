<?php

namespace App\Listeners;

use App\Events\FailedLogin;
use App\Notifications\FailedLoginNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;

class FailedLoginListener
{
    /**
     * IP address
     *
     * @var string
     */
    public string $ip;

    /**
     * User-Agent
     * @var string
     */
    public string $ua;

    /**
     * Create the event listener.
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->ip = $request->ip();
        $this->ua = filter_var($request->userAgent(), FILTER_SANITIZE_STRING);
    }

    /**
     * Handle the event.
     *
     * @param FailedLogin $event
     * @return void
     */
    public function handle(FailedLogin $event)
    {
        activity('session_logs')->on($event->user)->by($event->user)
            ->withProperties(['IP' => $this->ip, 'UserAgent' => $this->ua])
            ->log('Failed login attempt');
        $event->user->notify(new FailedLoginNotification($this->ip, $this->ua));
    }
}
