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
        $query = Work::query()
            ->with(['user', 'category'])
            ->where('status', 'active');

        // -- Search ------------------------------------
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('position', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', fn ($u) =>
                      $u->where('name', 'like', "%{$searchTerm}%"));
            });
        }

        // -- Job type filter ---------------------------
        if ($request->filled('type')) {
            $types = $request->input('type');
            $types = is_array($types) ? $types : [$types];
            $query->whereIn('type', $types);
        }

        // -- Category filter ---------------------------
        if ($request->filled('category')) {
            $cats = $request->input('category');
            $cats = is_array($cats) ? $cats : [$cats];
            $query->whereIn('category_id', $cats);
        }

        // -- Sorting -----------------------------------
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'title_asc':
                $query->orderBy('title');
                break;
            case 'title_desc':
                $query->orderByDesc('title');
                break;
            case 'company':
                // keep eager load intact
                $query->orderBy(
                    User::select('name')
                        ->whereColumn('users.id', 'works.user_id')
                        ->limit(1)
                );
                break;
            default:
                $query->latest();
        }

        // -- Pagination --------------------------------
        $works = $query->paginate(10)->withQueryString();

        // -- Category + Type counts --------------------
        $categories = Category::query()
            ->withCount(['works' => fn($q) => $q->where('status', 'active')])
            ->get();

        $jobTypeCounts = Work::query()
            ->where('status', 'active')
            ->selectRaw('type, count(*) as count')
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
