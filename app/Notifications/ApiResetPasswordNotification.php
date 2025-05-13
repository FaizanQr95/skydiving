<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ApiResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;
    // public $customUrl; // If you want to pass a pre-built URL

    public function __construct($token/*, $customUrl = null*/)
    {
        $this->token = $token;
        // $this->customUrl = $customUrl;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // This is the default logic. Modify as needed.
        // The key is the URL passed to ->action()
        // It uses route('password.reset', ...) which might not be what you want for an API-first approach
        // if your frontend is completely separate.

        // Construct the URL to your frontend reset page
        $frontendResetUrl = config('app.frontend_url', config('app.url')); // e.g., https://my-spa.com
        $resetUrl = $frontendResetUrl . '/reset-password/' . $this->token . '?email=' . urlencode($notifiable->getEmailForPasswordReset());

        return (new MailMessage)
            ->subject('Reset Your Password (API)')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $resetUrl) // <<< This is the important part
            ->line('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])
            ->line('If you did not request a password reset, no further action is required.');
    }
}
