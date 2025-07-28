<?php

namespace App\Mail;

use App\Models\Applicant;
use App\Models\User;
use App\Models\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendApplicantCV extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $work;
    public $applicant;

    /**
     * Create a new message instance.
     */
   public function __construct($userId, $workId, $applicantId)
{
    $this->user = User::find($userId);
    $this->work = Work::find($workId);
    $this->applicant = Applicant::find($applicantId);


     Log::info('User:', ['user' => $this->user]);
    Log::info('Work:', ['work' => $this->work]);
    Log::info('Applicant:', ['applicant' => $this->applicant]);
}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
        from: new Address(config('mail.from.address'), config('mail.from.name')),
        replyTo: [new Address($this->user->email, $this->user->name)],
        subject: 'New Job Application for: ' . $this->work->title,
    );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.jobapplicant',
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
     * , \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attach the resume file
            \Illuminate\Mail\Mailables\Attachment::fromPath(storage_path('app/public/resumes/' . $this->applicant->resume))
                ->as('resume.' . pathinfo($this->applicant->resume, PATHINFO_EXTENSION))
                ->withMime('application/pdf'),  // or detect mime type dynamically if needed
        ];
    }
}
