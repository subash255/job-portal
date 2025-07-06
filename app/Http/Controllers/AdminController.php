<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function jobs()
    {
        return view('admin.jobs.index',
        [
            'title' => 'Jobs',
            'active' => 'jobs',
        ]);
    }

    public function employers()
    {
        return view('admin.employers.index',
        [
            'title' => 'Employers',
            'active' => 'employers',
        ]);
    }

    public function jobseekers()
    {
        return view('admin.jobseeker.index',
        [
            'title' => 'Job Seekers',
            'active' => 'jobseekers',
        ]);
    }

}
