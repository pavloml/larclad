<?php

namespace App\Listeners;

use App\Events\EmailUpdated;
use App\Notifications\EmailUpdatedNotification;
use App\Notifications\PasswordUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class EmailUpdateListener
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
     * @param EmailUpdated $event
     * @return void
     */
    public function handle(EmailUpdated $event)
    {
        activity('user_updates_log')->on($event->user)->by($event->user)
            ->withProperties(['IP' => $this->ip, 'UserAgent' => $this->ua])
            ->log('Email change');
        $event->user->notify(new EmailUpdatedNotification($this->ip, $this->ua));
    }
}
