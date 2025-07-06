<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Logic to display user dashboard or profile
        return view('user.index');
    }
    
}
