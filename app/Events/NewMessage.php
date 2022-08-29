<?php

namespace App\Events;

use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Recipient
     * @var User
     */
    public User $recipient;

    /**
     * Sender
     * @var User
     */
    public User $sender;

    /**
     * Post
     * @var Post
     */
    public Post $post;

    /**
     * Thread
     * @var Thread
     */
    public Thread $thread;

    /**
     * Create a new event instance.
     * @param User $recipient
     * @param User $sender
     * @param Post $post
     * @param Thread $thread
     * @return void
     */
    public function __construct(User $recipient, User $sender, Post $post, Thread $thread)
    {
        $this->recipient = $recipient;
        $this->sender = $sender;
        $this->post = $post;
        $this->thread = $thread;
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
