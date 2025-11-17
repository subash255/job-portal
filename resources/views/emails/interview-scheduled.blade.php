@component('mail::message')
# Interview Scheduled

Dear {{ $applicant->user->name }},

Congratulations! Your interview for the position of **{{ $jobTitle }}** at **{{ $companyName }}** has been scheduled.

## Interview Details

**Position:** {{ $jobTitle }}  
**Company:** {{ $companyName }}  
**Date & Time:** {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('l, F j, Y \a\t g:i A') }}  
**Interview Type:** {{ $interview->meet_link ? 'Online (Google Meet)' : 'Walk-in Interview' }}

@if($interview->meet_link)
## Join the Interview

Click the button below to join the Google Meet video conference at the scheduled time.

@component('mail::button', ['url' => $interview->meet_link, 'color' => 'success'])
Join Google Meet
@endcomponent

**Meeting Link:** {{ $interview->meet_link }}

### Important Notes:
- Please join 5 minutes before the scheduled time
- Make sure your camera and microphone are working
- Choose a quiet place with good internet connection
- Keep your resume and portfolio ready for discussion
@else
## Walk-in Interview

Please visit the company office at the scheduled time. Check your email for the complete address and directions.

### What to Bring:
- Valid ID
- Updated resume (printed)
- Portfolio or work samples (if applicable)
- Any relevant certificates or documents
@endif

## Preparation Tips

- Review the job description thoroughly
- Research about our company
- Prepare answers for common interview questions
- Prepare questions you'd like to ask us
- Dress professionally (even for online interviews)

We look forward to meeting you!

Best regards,  
{{ $companyName }}

@component('mail::subcopy')
If you have any questions or need to reschedule, please contact us immediately at {{ config('mail.from.address') }}
@endcomponent
@endcomponent
