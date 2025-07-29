<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>New Job Application</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; color: #333;">
  <div style="max-width: 600px; margin: auto; background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
    <h2 style="color: #2c3e50;">New Job Application: {{ $work->title }}</h2>

    <p><strong>Applicant Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $applicant->phone ?? 'N/A' }}</p>
    <p><strong>Address:</strong> {{ $applicant->address ?? 'N/A' }}</p>
    <p><strong>Experience:</strong> {{ $applicant->experience ?? 'N/A' }}</p>
    <p><strong>Education:</strong> {{ $applicant->education ?? 'N/A' }}</p>
    <p><strong>Skills:</strong> {{ $applicant->skills ?? 'N/A' }}</p>

    <p><strong>Cover Letter:</strong></p>
    <div style="background: #f4f4f4; padding: 15px; border-left: 4px solid #3498db; margin-bottom: 20px;">
      {{ $applicant->cover_letter ?? 'N/A' }}
    </div>

    <p><strong>Portfolio:</strong> 
      @if($applicant->portfolio_url)
        <a href="{{ $applicant->portfolio_url }}" style="color: #2980b9;" target="_blank">{{ $applicant->portfolio_url }}</a>
      @else
        N/A
      @endif
    </p>



    <hr style="margin: 30px 0;">

    <p><strong>Resume:</strong> Attached with this email.</p>
    <p>If you’re unable to view the attachment, you can also access it <a href="{{ asset('storage/' . $applicant->resume) }}" target="_blank" style="color: #27ae60;">here</a>.</p>

    <p style="margin-top: 40px; font-size: 0.9em; color: #888;">This email was generated automatically by the job portal system.</p>
  </div>
</body>
</html>
