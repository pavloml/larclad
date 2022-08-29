<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAbuseReportNotification extends Notification
{
    use Queueable;

    /**
     * @var Post
     */
    private Post $post;

    /**
     * @var string
     */
    private string $reason;

    /**
     * Create a new notification instance.
     *
     * @param Post $post
     * @param string $reason
     * @return void
     */
    public function __construct(Post $post, string $reason)
    {
        $this->post = $post;
        $this->reason = $reason;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('New abuse report'))
                    ->line(__('We received a new abuse report'))
                    ->line(__('Reason: ') . $this->reason)
                    ->action(__('Go to post'), route('post.show', ['id' => $this->post->id]));
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
            //
        ];
    }
}
