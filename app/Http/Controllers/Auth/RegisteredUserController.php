<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller  
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function companystore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[\+]?[0-9\s\-\(\)]{10,15}$/', 'max:15'],
            'role' => ['nullable', 'string'], 
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'phone.required' => 'Contact number is required.',
            'phone.regex' => 'Contact number must be a valid phone number containing only numbers, spaces, hyphens, and parentheses.',
            'name.min' => 'Company name must be at least 2 characters.',
            'name.required' => 'Company name is required.',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role , 
            'password' => Hash::make($request->password),

        ]);
        
        // Assign the 'user' role by default if no role is specified
        // $user->assignRole('user');   
       
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('verification.notice', absolute: false));
    }
     public function userstore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[\+]?[0-9\s\-\(\)]{10,15}$/', 'max:15'],
            'role' => ['nullable', 'string'], 
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'phone.required' => 'Contact number is required.',
            'phone.regex' => 'Contact number must be a valid phone number containing only numbers, spaces, hyphens, and parentheses.',
            'name.min' => 'Full name must be at least 2 characters.',
            'name.required' => 'Full name is required.',
        ]);
        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role , 
            'password' => Hash::make($request->password),

        ]);
        
        // Assign the 'user' role by default if no role is specified
        // $user->assignRole('user');   
       
        event(new Registered($user));

       Auth::login($user);

        return redirect(route('verification.notice', absolute: false));
    }
}
