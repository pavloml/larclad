<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;
    private array $formData;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;
        $this->subject = __('New contact form submission:') . ' ' . $formData['subject'];

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact')->with('formData', $this->formData);
    }
}
