<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendApplicantCV extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $work;
    public $applicant;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $work, $applicant)
    {
        $this->user = $user;
        $this->work = $work;
        $this->applicant = $applicant;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Job Application for: ' . $this->work->title,
            replyTo: [
                $this->user->email => $this->user->name,
            ],
            from: config('mail.from'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.applicant_cv',
            with: [
                'user' => $this->user,
                'work' => $this->work,
                'applicant' => $this->applicant,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attach the resume file
            \Illuminate\Mail\Mailables\Attachment::fromPath(storage_path('app/' . $this->applicant->resume))
                ->as('resume.' . pathinfo($this->applicant->resume, PATHINFO_EXTENSION))
                ->withMime('application/pdf'),  // or detect mime type dynamically if needed
        ];
    }
}
