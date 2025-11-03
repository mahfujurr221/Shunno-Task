@component('mail::message')
# Exam Reminder

Dear Student,

This is a reminder that you have an upcoming exam scheduled on **{{ $examDate }}**.  
Please prepare accordingly.

@component('mail::button', ['url' => '#'])
View Exam Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent