<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;
use App\Models\Applicant;
use App\Models\Category;
use App\Models\Visitor;

class AdminController extends Controller
{
    public function index()
    {
        // Calculate dashboard statistics
        $totalJobs = Work::count();
        $activeJobs = Work::where('status', 'active')->count();
        $closedJobs = Work::where('status', 'closed')->count();
        $featuredJobs = Work::where('featured', true)->count();
        
        $totalEmployers = User::where('role', 'company')->count();
        $totalJobSeekers = User::where('role', 'user')->count();
        $totalApplications = Applicant::count();
        $totalCategories = Category::count();
        
        // Recent applications (last 7 days)
        $recentApplications = Applicant::where('created_at', '>=', now()->subDays(7))->count();
        
        // Visitor statistics
        $totalVisitors = Visitor::getTotalVisits();
        $totalUniqueVisitors = Visitor::getTotalUniqueVisitors();
        $todayVisitors = Visitor::getTodayVisits();
        $todayUniqueVisitors = Visitor::getTodayUniqueVisitors();
        $visitsLast30Days = Visitor::getVisitsLast30Days();
        
        // Get recent jobs for activity feed
        $recentJobs = Work::with('user')
            ->latest()
            ->take(5)
            ->get();
        
        // Get recent applications for activity feed
        $recentApplicationsList = Applicant::with(['work', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'totalJobs',
            'activeJobs', 
            'closedJobs',
            'featuredJobs',
            'totalEmployers',
            'totalJobSeekers',
            'totalApplications',
            'totalCategories',
            'recentApplications',
            'totalVisitors',
            'totalUniqueVisitors',
            'todayVisitors',
            'todayUniqueVisitors',
            'visitsLast30Days',
            'recentJobs',
            'recentApplicationsList'
        ), [
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
