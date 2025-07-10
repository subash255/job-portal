<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function index()
    {
        $works = Work::with(['user', 'category'])
            ->where('status', 'active')
            ->where('featured', true)
            ->latest()
            ->take(6)
            ->get(); 
        $latestWorks = Work::with(['user', 'category'])
            ->where('status', 'active')
            ->latest()
            ->take(6)
            ->get();
        return view('welcome', compact('works', 'latestWorks'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function job(Request $request)
    {
        $query = Work::with(['user', 'category'])->where('status', 'active');

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('position', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Job type filter
        if ($request->filled('type')) {
            $types = is_array($request->type) ? $request->type : [$request->type];
            $query->whereIn('type', $types);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereIn('category_id', $request->category);
        }

        // Sorting
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'company':
                $query->join('users', 'works.user_id', '=', 'users.id')
                      ->orderBy('users.name', 'asc')
                      ->select('works.*');
                break;
            default: // latest
                $query->latest();
                break;
        }

        // Pagination
        $works = $query->paginate(10);

        // Get categories with job counts for filter
        $categories = Category::withCount(['works' => function($q) {
            $q->where('status', 'active');
        }])->get();

        // Get job type counts for filter
        $jobTypeCounts = Work::where('status', 'active')
            ->select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        return view('job', compact('works', 'categories', 'jobTypeCounts'));
    }

    public function jobDetail($id)
    {
        try {
            $work = Work::with(['user', 'category'])->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('job')->with('error', 'This job is no longer available.');
        }
        return view('job-detail', compact('work'));
    }
}
