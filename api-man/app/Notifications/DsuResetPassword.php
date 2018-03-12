<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\DsuResetPassword as Mailable;

class DsuResetPassword extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = 'Test reset';
        return (new Mailable($this->token, $notifiable))->subject($subject)->to($notifiable->email);
//        return (new MailMessage)
//            ->line('You are receiving this email because we received a password reset request for your account.')
//            ->action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
//            ->line('If you did not request a password reset, no further action is required.');
    }
}
