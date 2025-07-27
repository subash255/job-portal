<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            if($request->user()->role === 'company') {
                 return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('company.index', absolute: false))
                    : view('auth.verify-email');
            } elseif($request->user()->role === 'user') {
             return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('user.index', absolute: false))
                    : view('auth.verify-email');
            }
        }

        return view('auth.verify-email');
    }
}
