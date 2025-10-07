<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class roleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Please login to access this page.');
        }

        // Check if email is verified
        if (is_null(Auth::user()->email_verified_at)) {
            return redirect()->route('verification.notice')->with('warning', 'Please verify your email address to continue.');
        }

        $userRole = Auth::user()->role;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have access.');
    }
}
