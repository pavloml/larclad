<?php

namespace App\Listeners;

use App\Events\NewMessage;
use App\Notifications\NewMessageNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewMessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewMessage  $event
     * @return void
     */
    public function handle(NewMessage $event)
    {
        $event->recipient->notify(new NewMessageNotification($event->sender, $event->thread));
    }
}
