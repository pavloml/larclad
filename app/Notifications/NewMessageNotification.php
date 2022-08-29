<?php

namespace App\Notifications;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    /**
     * @var User sender
     */
    private User $sender;


    /**
     * @var Thread thread
     */
    private Thread $thread;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sender, $thread)
    {
        $this->sender = $sender;
        $this->thread = $thread;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('New message from: ') . $this->sender->name)
                    ->line(__('You have a new message from: ') . $this->sender->name)
                    ->line(__('Thread: ') . $this->thread->post->title)
                    ->action(__('Reply'), route('profile.messages.thread', ['thread_id' => $this->thread->id]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => __('You have a new message from') . $this->sender
        ];
    }
}
