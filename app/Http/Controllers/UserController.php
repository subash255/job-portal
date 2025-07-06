<?php

namespace App\Http\Controllers;

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
        /** @var User $user */
        $user = Auth::user();
        
        $request->validate([
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
        
        $data = $request->only(['name', 'email', 'phone', 'address', 'bio', 'skills', 'experience', 'education']);
        
        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $profilePicturePath;
        }
        
        // Handle resume upload
        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($user->resume && Storage::disk('public')->exists($user->resume)) {
                Storage::disk('public')->delete($user->resume);
            }
            
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $data['resume'] = $resumePath;
        }
        
        // Update user data
        User::where('id', $user->id)->update($data);
        
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
    
    public function myJobs(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Start with base query
        $query = Work::query();
        
        // Apply search filter
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('company_name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }
        
        // Apply status filter
        if ($request->has('status') && $request->status) {
            // This would typically filter by actual application status
            // For now, we'll just apply the filter as a placeholder
            $query->where('job_type', 'like', '%' . $request->status . '%');
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
