<?php

namespace App\Listeners;

use App\Events\ProfileUpdated;
use App\Notifications\PasswordUpdatedNotification;
use App\Notifications\ProfileUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class ProfileUpdateListener
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
     * @param ProfileUpdated $event
     * @return void
     */
    public function handle(ProfileUpdated $event)
    {
        activity('user_updates_log')->on($event->user)->by($event->user)
            ->withProperties(['IP' => $this->ip, 'UserAgent' => $this->ua])
            ->log('Profile updated');
        $event->user->notify(new ProfileUpdatedNotification($this->ip, $this->ua));
    }
}
