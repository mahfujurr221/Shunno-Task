<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\ExamReminderMail;
use Illuminate\Support\Facades\Mail;

class SendExamReminder extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'exam:reminder';

    /**
     * The console command description.
     */
    protected $description = 'Send exam reminder emails to all students';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $examDate = '2025-08-15';

        // Get all students
        $students = User::where('type', 'student')->get();

        foreach ($students as $student) {
            Mail::to($student->email)->send(new ExamReminderMail($examDate));
        }

        $this->info('Exam reminder emails sent successfully!');
    }
}
