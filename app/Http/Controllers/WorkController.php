<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()
    {
        // Fetch all works from the database
        $works = Work::with('category','user')->get();

        // Return the view with the works data
        return view('admin.jobs.index', compact('works'), [
            'title' => 'Manage Jobs'
        ]);
    }
    public function create()
    {
        // Fetch all categories from the database
        $categories = Category::all();

        // Return the view to create a new work
        return view('works.create', compact('categories'), [
            'title' => 'Create New Job'
        ]);
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'responsibility' => 'nullable|string',
            'benefits' => 'nullable|string',
            'company_email' => 'nullable|email|max:255',
            'company_phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'salary' => 'nullable|string|max:255',
            'type' => 'required|string|in:full-time,part-time,contract,internship',
            'status' => 'required|boolean',
            'slug' => 'required|string|max:255|unique:works,slug',
            'user_id' => Auth::id(), 
            
            'expected_requirement' => 'nullable|string',
            
        ]);

        // Handle file upload for the image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $request->merge(['image' => $imagePath]);
        }
        // Generate a unique slug for the wo

        // Create a new work record in the database
        Work::create($request->all());


        // Redirect to the works index page with a success message
        return redirect()->route('works.index')->with('success', 'Work created successfully.');
    }
    public function show($id)
    {
        // Fetch the work by ID
        $work = Work::with('category')->findOrFail($id);

        // Return the view to show the work details
        return view('works.show', compact('work'));
    }
    public function edit($id)
    {
        // Fetch the work by ID
        $work = Work::with('category')->findOrFail($id);

        // Fetch all categories from the database
        $categories = Category::all();

        // Return the view to edit the work
        return view('works.edit', compact('work', 'categories'), [
            'title' => 'Edit Job'
        ]);
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'responsibility' => 'nullable|string',
            'benefits' => 'nullable|string',
            'expected_requirement' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        // Fetch the work by ID
        $work = Work::findOrFail($id);

        // Update the work record in the database
        $work->update($request->all());

        // Redirect to the works index page with a success message
        return redirect()->route('works.index')->with('success', 'Work updated successfully.');
    }       

    public function destroy($id)
    {
        // Fetch the work by ID
        $work = Work::findOrFail($id);

        // Delete the work record from the database
        $work->delete();

        // Redirect to the works index page with a success message
        return redirect()->route('works.index')->with('success', 'Work deleted successfully.');
    }
    public function changeStatus($id)
    {
        // Fetch the work by ID
        $work = Work::findOrFail($id);

        // Toggle the status of the work
        $work->status = !$work->status;
        $work->save();

        // Redirect to the works index page with a success message
        return redirect()->route('works.index')->with('success', 'Work status changed successfully.');
    }
    
    public function showWork($id)
    {
        // Fetch the work by ID
        $work = Work::with('category')->findOrFail($id);

        // Return the view to show the work details
        return view('works.show', compact('work'));
    }
    public function apply($id)
    {
        // Fetch the work by ID
        $work = Work::with('category')->findOrFail($id);

        // Return the view to apply for the work
        return view('works.apply', compact('work'));
    }
    public function submitApplication(Request $request, $id)
    {
        // Validate the request data
        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string',
        ]);

        // Handle the application submission logic here
        // You can save the resume and cover letter to the database or send an email

        return redirect()->route('works.index')->with('success', 'Application submitted successfully.');
    }
}
