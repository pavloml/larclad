<?php

namespace App\Listeners;

use App\Events\SuccessfulLogin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;

class SuccessfulLoginListener
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
     * @param SuccessfulLogin | Registered $event
     * @return void
     */
    public function handle(SuccessfulLogin | Registered $event)
    {
        activity('sessions_log')->on($event->user)->by($event->user)
            ->withProperties(['IP' => $this->ip, 'UserAgent' => $this->ua])
            ->log('Successful login');
        // $event->user->notify(new SuccessfulLogin($this->ip, $this->ua));
    }
}
