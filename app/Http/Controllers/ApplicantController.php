<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function store(Request $request, $work)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to apply for a job.');
    }

    // Retrieve the Work model
    $work = Work::findOrFail($work);
    $company_id = $work->user_id;

    // Merge necessary values into the request
    $request->merge([
        'company_id' => $company_id,
        'applicant_id' => Auth::id(),
    ]);

    // Validate only `status` (work_id and applicant_id come from system)
    $data = $request->validate([
        'status' => 'nullable|in:applied, interviewed, hired, rejected',
    ]);

    // Create the applicant record
    $applicant = new Applicant();
    $applicant->work_id = $work->id;
    $applicant->applicant_id = Auth::id();
    $applicant->company_id = $company_id;
    $applicant->status = 'applied';
    $applicant->save();

    return redirect()->route('user.my-jobs')->with('success', 'Application submitted successfully!');
}

}
