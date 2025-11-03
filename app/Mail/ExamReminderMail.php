<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExamReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;

    public $examDate;

    /**
     * Create a new message instance.
     */
    public function __construct($examDate)
    {
        $this->examDate = $examDate;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Exam Topic Reminder')
                    ->markdown('emails.exam_reminder')
                    ->with([
                        'examDate' => $this->examDate,
                    ]);
    }
}
