<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PhoneNumberUpdatedNotification extends Notification
{
    use Queueable;

    private string $ip;
    private string $ua;

    /**
     * @param string $ip User's IP
     * @param string $ua User's User-Agent
     * @return void
     */
    public function __construct($ip, $ua)
    {
        $this->ip = $ip;
        $this->ua = $ua;
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
            ->subject(__('Phone Number Updated'))
            ->line(__('The phone number associated with your account was changed.'))
            ->line(__('Please contact administrator if you did not authorize this change.'))
            ->line(__('Time: ') . now()->format('D, M j, g:i A Y T'))
            ->line(__('IP address: ') . $this->ip)
            ->line(__('Device: ') . $this->ua);
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
            'message' => __('The phone number with your account was changed. Please contact administrator if you did not authorize this change.')
        ];
    }
}
