<?php

namespace App\Http\Controllers;

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
        // Logic to display company dashboard
        return view('company.index', ['section' => 'dashboard']);
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
        // Logic to display company applications
        return view('company.index', ['section' => 'applications']);
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

       

}
