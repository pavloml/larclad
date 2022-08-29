<?php

namespace App\Events;

use App\Models\Complain;
use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewAbuseReport
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Complain
     */
    public Complain $complain;

    /**
     * @var Post
     */
    public Post $post;

    /**
     * Create a new event instance.
     *
     * @param Complain $complain
     * @param Post $post
     */
    public function __construct(Complain $complain, Post $post)
    {
        $this->complain = $complain;
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
