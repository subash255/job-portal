<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
       

}
