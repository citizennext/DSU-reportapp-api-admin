<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DsuResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    protected $notifiable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $notifiable)
    {
        $this->token = $token;
        $this->notifiable = $notifiable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.dsuresetpassword', [
            'greeting' => __('mail.greetings.informal') . ' ' . $this->notifiable->name . ',',
            'body_message' => __('mail.body.reset_password'),
            'level' => 'error',
            'actionUrl' => url(config('app.url').route('password.reset', $this->token, false)),
            'actionText' => __('mail.buttons.reset_password'),
            'salutation' => __('mail.greetings.salutation'),
            'signature' => __('mail.greetings.signature_tehnic'),
            'subcopy_content' => __('mail.subcopy.reset_password', ['actionText' => __('mail.buttons.reset_password')]),
        ]);
    }
}
