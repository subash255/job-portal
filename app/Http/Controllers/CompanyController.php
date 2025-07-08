<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Category;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        // Get applications for jobs posted by this company
        $applications = Applicant::with(['work', 'user'])
            ->whereHas('work', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->latest()
            ->get();
            
        $works = Work::where('user_id', Auth::id())->latest()->get();
        $totalapplicant = 0;
        foreach ($works as $work) {
            $totalapplicant += $work->applicants()->count();
        }
        
        // Calculate dynamic stats
        $totalJobs = $works->count();
        $totalApplications = $totalapplicant;
        $activeJobs = $works->where('status', 'active')->count();
        $closedJobs = $works->where('status', 'closed')->count();
        $recentJobs = $works->take(5); // Get 5 most recent jobs
        $recentApplications = $applications->take(5); // Get 5 most recent applications
        
        // For interviews, we'll simulate with pending applications for now
        $interviews = $applications->where('status', 'interview')->count();
        
        // Logic to display company dashboard
        return view('company.index', compact(
            'applications',
            'works',
            'totalapplicant',
            'totalJobs',
            'totalApplications',
            'activeJobs',
            'closedJobs',
            'recentJobs',
            'recentApplications',
            'interviews'
        ), ['section' => 'dashboard']);
    }

    public function create()
    {
        // Logic to show the job posting form
        $categories = Category::all(); // Assuming you have a Category model
        return view('company.create', ['categories' => $categories]);
       
    }

    public function jobs()
    {
        $works = Work::where('user_id', Auth::id())->with('category')->get();
        // Logic to display company jobs
        return view('company.index',compact('works') ,['section' => 'jobs']);
    }

    public function applications()
    {
        // Get applications for jobs posted by this company with pagination
        $applications = Applicant::with(['work', 'user'])
            ->whereHas('work', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->latest()
            ->paginate(10);
        
        // Logic to display company applications
        return view('company.index', compact('applications'), ['section' => 'applications']);
    }

    public function profile()
    {
        // Logic to display company profile
        return view('company.index', ['section' => 'profile']);
    }

    public function settings()
    {
        // Logic to display company settings
        return view('company.index', ['section' => 'settings']);
    }

    public function store(Request $request)

    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'end_date' => 'required|date|after:today',
            'status' => 'required|in:active,closed',
            'description' => 'required|string',
        ]);

        Work::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category_id' => $request->category_id,
            'position' => $request->position,
            'location' => $request->location,
            'type' => $request->type,
            'salary' => $request->salary,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'description' => $request->description,
            
        ]);

        return redirect()->route('company.index')->with('success', 'Job posted successfully!');
    }

   

public function profileupdate(Request $request)
{
    
    $data = $request->validate([
        'name' => 'nullable|string|max:255',
        'industry' => 'nullable|string|max:255',
        'company_size' => 'nullable|string|max:255',
        'founded_year' => 'nullable|string',
        'description' => 'nullable|string',
        'company_website' => 'nullable|url|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'postal_code' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
        'linkedin' => 'nullable|url|max:255',
        'company_twitter' => 'nullable|url|max:255',
        'company_facebook' => 'nullable|url|max:255',
        'company_instagram' => 'nullable|url|max:255',
        'profile_picture' => 'nullable|image|max:2048',
    ]);
   

    $user = User::find(Auth::id());

    // Handle logo upload and store path in $data
    if ($request->hasFile('profile_picture')) {
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $data['profile_picture'] = $request->file('profile_picture')->store('company_logos', 'public');
    }

    // Update user record with validated data
   
    $user->update($data);
 

    return redirect()->back()->with('success', 'Company profile updated successfully.');
}

public function edit($id)
    {
        $work = Work::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('company.edit', compact('work', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $work = Work::where('user_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'end_date' => 'required|date|after:today',
            'status' => 'required|in:active,closed',
            'description' => 'required|string',
        ]);

        $work->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'position' => $request->position,
            'location' => $request->location,
            'type' => $request->type,
            'salary' => $request->salary,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('company.jobs')->with('success', 'Job updated successfully!');
    }

    public function destroy($id)
    {
        $work = Work::where('user_id', Auth::id())->findOrFail($id);
        $work->delete();
        
        return redirect()->route('company.jobs')->with('success', 'Job deleted successfully!');
    }
    
    public function updateApplicationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:applied,under_review,shortlisted,interview,rejected'
        ]);
        
        $application = Applicant::with('work')
            ->whereHas('work', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->findOrFail($id);
        
        $application->update([
            'status' => $request->status
        ]);
        
        $statusMessages = [
            'applied' => 'Application status updated to Applied',
            'under_review' => 'Application moved to Under Review',
            'shortlisted' => 'Applicant shortlisted successfully',
            'interview' => 'Interview scheduled for applicant',
            'rejected' => 'Application rejected'
        ];
        
        return redirect()->route('company.applications')
            ->with('success', $statusMessages[$request->status]);
    }

}
