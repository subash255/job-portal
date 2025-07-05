<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        // Logic to display company dashboard or profile
        return view('company.index');
    }


    public function create()
    {
        // Logic to show the job posting form
        return view('company.create');
    }
}
