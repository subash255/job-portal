<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendApplicantCV;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    public function store(Request $request, $work)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to apply for a job.');
        }

        // Retrieve the Work model
        try {
            $work = Work::findOrFail($work);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('job')->with('error', 'This job is no longer available.');
        }
        
        // Check if user has already applied
        $hasApplied = Applicant::where('work_id', $work->id)
                               ->where('applicant_id', Auth::id())
                               ->exists();

        if ($hasApplied) {
            return redirect()->route('job.detail', $work->id)->with('error', 'You have already applied for this job.');
        }

        $company_id = $work->user_id;

        // Validate the form data
        $data = $request->validate([
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'experience' => 'nullable|string|max:1000',
            'education' => 'nullable|string|max:1000',
            'skills' => 'nullable|string|max:500',
            'cover_letter' => 'required|string|max:2000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'terms' => 'required|accepted',
        ]);

        // Handle resume upload if provided
       
      
if ($request->hasFile('resume')) {
    // User uploaded a new resume -> put directly into cv folder
    $cvPath = $request->file('resume')->store('cv', 'public');
} else {
    // Take existing resume from user's profile (in resumes/)
    $user = Auth::user();

    if ($user && $user->resume && Storage::disk('public')->exists($user->resume)) {
        // Generate a new filename for cv folder
        $filename = basename($user->resume); // e.g. "resume.pdf"
        $cvPath = 'cv/' . $filename;

        // Copy from resumes/ to cv/
        Storage::disk('public')->copy($user->resume, $cvPath);
    } else {
        $cvPath = null;
    }
}

        // Create the applicant record
        $applicant = new Applicant();
        $applicant->work_id = $work->id;
        $applicant->applicant_id = Auth::id();
        $applicant->company_id = $company_id;
        $applicant->status = 'applied';
        $applicant->phone = $data['phone'];
        $applicant->address = $data['address'];
        $applicant->experience = $data['experience'];
        $applicant->education = $data['education'];
        $applicant->skills = $data['skills'];
        $applicant->cover_letter = $data['cover_letter'];
        $applicant->resume = $cvPath;
        $applicant->applied_at = now();
        $applicant->save();

        // Retrieve the company (user) associated with the job
        $company = $work->user;
        $user = Auth::user();

        Mail::to($company->email)->queue(new SendApplicantCV($user->id, $work->id, $applicant->id));

        return redirect()->route('user.my-jobs')->with('success', 'Application submitted successfully!');
    }

public function create($work)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to apply for a job.');
        }

        try {
            $work = Work::with(['user', 'category'])->findOrFail($work);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('job')->with('error', 'This job is no longer available.');
        }
        
        // Check if user has already applied
        $hasApplied = Applicant::where('work_id', $work->id)
                               ->where('applicant_id', Auth::id())
                               ->exists();

        if ($hasApplied) {
            return redirect()->route('job.detail', $work->id)->with('error', 'You have already applied for this job.');
        }

        return view('apply-job', compact('work'));
    }
}
