<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FailedLogin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User
     * @var User
     */
    public User $user;


    /**
     * Create a new event instance.
     * @param User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
