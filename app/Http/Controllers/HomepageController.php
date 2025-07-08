<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()

    {
        $works = Work::all(); 
        $latestWorks = Work::latest()->take(3)->get(); // Fetch the latest 6 works
        return view('welcome',compact('works', 'latestWorks'));
    }
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
    public function job()
    {
        $works = Work::all();
        return view('job', compact('works'));
    }
}
