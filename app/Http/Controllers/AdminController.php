<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;

class AdminController extends Controller
{
    public function index()

    {
        return view('admin.index',
        [
            'title' => 'Admin Dashboard',
            'active' => 'admin',
        ]);
    }


    public function employers()
    {
        $employers = User::where('role', 'company')
            ->withCount(['works' => function($query) {
                $query->where('status', 'active');
            }])
            ->get();
        
        return view('admin.employers.index', compact('employers'), [
            'title' => 'Manage Employers',
            'active' => 'employers',
        ]);
    }

    public function jobseekers()
    {
        $jobseekers = User::where('role', 'user')->get();
        
        return view('admin.jobseeker.index', compact('jobseekers'), [
            'title' => 'Manage Job Seekers',
            'active' => 'jobseekers',
        ]);
    }

    public function destroyEmployer($id)
    {
        $employer = User::where('role', 'company')->findOrFail($id);
        $employer->delete();
        
        return redirect()->route('admin.employers.index')->with('success', 'Employer deleted successfully.');
    }

    public function destroyJobseeker($id)
    {
        $jobseeker = User::where('role', 'user')->findOrFail($id);
        $jobseeker->delete();
        
        return redirect()->route('admin.jobseeker.index')->with('success', 'Job seeker deleted successfully.');
    }

    public function toggleFeatured($id)
    {
        $work = Work::findOrFail($id);
        $work->featured = !$work->featured;
        $work->save();
        
        $status = $work->featured ? 'featured' : 'unfeatured';
        return redirect()->route('admin.jobs.index')->with('success', "Job has been {$status} successfully.");
    }

}
