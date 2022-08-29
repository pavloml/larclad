<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SuccessfulLogin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User
     * @var Authenticatable
     */
    public Authenticatable $user;


    /**
     * Create a new event instance.
     * @param Authenticatable $user
     * @return void
     */
    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
    }

}
