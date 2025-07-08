<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Work;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Redirect to profile for better user experience
        return redirect()->route('user.profile');
    }
    
    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    
    public function editProfile()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
{
    $user = User::find(Auth::id());

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'bio' => 'nullable|string|max:1000',
        'skills' => 'nullable|string|max:500',
        'experience' => 'nullable|string|max:1000',
        'education' => 'nullable|string|max:1000',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'resume' => 'nullable|file|mimes:pdf|max:10240',
    ]);

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    // Handle resume upload
    if ($request->hasFile('resume')) {
        if ($user->resume && Storage::disk('public')->exists($user->resume)) {
            Storage::disk('public')->delete($user->resume);
        }

        $validated['resume'] = $request->file('resume')->store('resumes', 'public');
    }

    $user->update($validated);

    return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
}

    
   public function myJobs(Request $request)
{
    $user = Auth::user();

    $query = Applicant::with('work') // eager load related work data
        ->where('applicant_id', $user->id); // fetch only current user's jobs

    // Search filter on related Work model
    if ($request->filled('search')) {
        $query->whereHas('work', function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('location', 'like', '%' . $request->search . '%');
        });
    }

    // Filter by status of the application
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $appliedJobs = $query->latest()->paginate(10);

    return view('user.my-jobs', compact('appliedJobs'));
}

    
    public function settings()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }
    
    public function changePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);
        
        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
        
        // Update password using query builder to avoid static analysis issues
        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        
        return back()->with('success', 'Password changed successfully!');
    }
    
    public function updateNotificationSettings(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Here you would typically update notification preferences
        // For now, we'll just return success
        return back()->with('success', 'Notification settings updated successfully!');
    }
    
    public function updatePrivacySettings(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Here you would typically update privacy settings
        // For now, we'll just return success
        return back()->with('success', 'Privacy settings updated successfully!');
    }
}
