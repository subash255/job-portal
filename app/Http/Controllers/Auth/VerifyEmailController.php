<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // Ensure the hash matches the user's email
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }

        // If already verified
        if ($user->hasVerifiedEmail()) {
            Auth::login($user);
            

            if($user->role === 'company') {
                return redirect()->route('company.index')->with('verified', true);
            } elseif($user->role === 'user') {
                return redirect()->route('user.index')->with('verified', true);
            }
            return redirect()->route('')->with('verified', true);
        }

        // ✅ Mark as verified (this updates email_verified_at in DB)
        $user->markEmailAsVerified();
        event(new Verified($user));

        // Auto-login after verification
        Auth::login($user);

     

            if($user->role === 'company') {
                return redirect()->route('company.index')->with('verified', true);
            } elseif($user->role === 'user') {
                return redirect()->route('user.index')->with('verified', true);
            }
        return redirect()->route('')->with('verified', true);
    }
}
