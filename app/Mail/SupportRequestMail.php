<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;
use App\Models\User; // Import the User model

class SupportRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $description;
    public $attachmentsData;
    public $userName;
    public $userEmail;

    /**
     * Create a new message instance.
     *
     * @param string $title
     * @param string $description
     * @param User|null $user The user object (or null if not found/provided optionally)
     * @param array $attachments Array of UploadedFile objects
     * @return void
     */
    public function __construct(string $title, string $description, ?User $user, array $attachments = [])
    {
        $this->title = $title;
        $this->description = $description;
        $this->attachmentsData = $attachments;

        if ($user) {
            $this->userName = $user->name;
            $this->userEmail = $user->email;
        } else {
            $this->userName = 'N/A (User not found or ID not provided)';
            $this->userEmail = 'N/A';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('emails.support.request')
            ->subject("Support: " . $this->title . " (From: " . $this->userName . ")"); // Add user name to subject

        foreach ($this->attachmentsData as $attachment) {
            if ($attachment instanceof UploadedFile && $attachment->isValid()) {
                $email->attachData(
                    $attachment->get(),
                    $attachment->getClientOriginalName(),
                    ['mime' => $attachment->getClientMimeType()]
                );
            }
        }

        return $email;
    }
}