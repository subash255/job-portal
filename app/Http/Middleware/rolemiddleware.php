<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class rolemiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role === 'user') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role === 'company') {
            return $next($request);
        }
      else
    {
    // If not, redirect to a different page or show an error
        return redirect('/')->with('error', 'You do not have access.');
    }
    }
    }

