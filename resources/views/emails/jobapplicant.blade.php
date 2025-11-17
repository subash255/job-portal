@component('mail::message')
# New Job Application Received

Dear Hiring Manager,

You have received a new application for the position of **{{ $work->title }}**.

## Applicant Information

**Name:** {{ $user->name }}  
**Email:** {{ $user->email }}  
**Phone:** {{ $applicant->phone ?? 'Not provided' }}  
**Location:** {{ $applicant->address ?? 'Not provided' }}

## Professional Background

**Experience:** {{ $applicant->experience ?? 'Not specified' }}  
**Education:** {{ $applicant->education ?? 'Not specified' }}  
**Key Skills:** {{ $applicant->skills ?? 'Not specified' }}

@if($applicant->cover_letter)
## Cover Letter

@component('mail::panel')
{{ $applicant->cover_letter }}
@endcomponent
@endif

@if($applicant->portfolio_url)
## Portfolio

@component('mail::button', ['url' => $applicant->portfolio_url, 'color' => 'primary'])
View Portfolio
@endcomponent
@endif

## Resume/CV

The applicant's resume has been attached to this email for your review.

@component('mail::button', ['url' => asset('storage/' . $applicant->resume), 'color' => 'success'])
Download Resume
@endcomponent

---

**Next Steps:**
- Review the application materials
- Shortlist candidates for interview
- Schedule interviews through your dashboard

Thank you,  
{{ config('app.name') }} Team

@component('mail::subcopy')
This is an automated notification from {{ config('app.name') }}. Please do not reply to this email.
@endcomponent
@endcomponent
