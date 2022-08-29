<?php

namespace App\Listeners;


use App\Events\PasswordUpdated;
use App\Notifications\PasswordUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class PasswordUpdateListener
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
     * @param Request $request
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
     * @param PasswordUpdated  $event
     * @return void
     */
    public function handle($event)
    {
        activity('user_updates_log')->on($event->user)->by($event->user)
            ->withProperties(['IP' => $this->ip, 'UserAgent' => $this->ua])
            ->log('Password change');
        $event->user->notify(new PasswordUpdatedNotification($this->ip, $this->ua));
    }
}
