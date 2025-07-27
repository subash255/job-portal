<!DOCTYPE html>
<html lang="en">
<h3>New Application for Job: {{ $work->title }}</h3>

<p><strong>Applicant Name:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Phone:</strong> {{ $applicant->phone ?? 'N/A' }}</p>
<p><strong>Address:</strong> {{ $applicant->address ?? 'N/A' }}</p>
<p><strong>Experience:</strong> {{ $applicant->experience ?? 'N/A' }}</p>
<p><strong>Education:</strong> {{ $applicant->education ?? 'N/A' }}</p>
<p><strong>Skills:</strong> {{ $applicant->skills ?? 'N/A' }}</p>
<p><strong>Cover Letter:</strong></p>
<p>{{ $applicant->cover_letter ?? 'N/A' }}</p>
<p><strong>Portfolio:</strong> <a href="{{ $applicant->portfolio_url }}">{{ $applicant->portfolio_url }}</a></p>
<p><strong>Expected Salary:</strong> {{ $applicant->expected_salary ?? 'N/A' }}</p>
<p><strong>Available From:</strong> {{ $applicant->availability_date ?? 'N/A' }}</p>

<p>The applicant's resume is attached with this email.</p>

</html>