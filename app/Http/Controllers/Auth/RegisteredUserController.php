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
            'name' => ['required', 'string', 'max:255'],//test
            'phone' => ['nullable', 'string', 'max:15'],
            'role' => ['nullable', 'string', ], 
            
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:15'],
            'role' => ['nullable', 'string', ], // Allow 'user' or 'admin' roles

            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
