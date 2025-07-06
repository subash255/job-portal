@extends('user.layout')

@section('user-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Profile</h1>
                <p class="text-gray-600">Update your profile information and preferences</p>
            </div>
            <a href="{{ route('user.profile') }}" class="text-gray-600 hover:text-gray-800 transition-colors duration-200">
                <i class="ri-arrow-left-line text-xl"></i>
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4">
            <div class="flex items-center gap-2">
                <i class="ri-check-circle-line text-green-600"></i>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Profile Form -->
    <form action="{{ route('user.update-profile') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Basic Information -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="ri-user-line text-indigo-500"></i>
                Basic Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Phone Number
                    </label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                        Address
                    </label>
                    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('address') border-red-500 @enderror">
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Bio -->
            <div class="mt-6">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                    Bio / About Me
                </label>
                <textarea id="bio" name="bio" rows="4" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('bio') border-red-500 @enderror"
                          placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Professional Information -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="ri-briefcase-line text-indigo-500"></i>
                Professional Information
            </h3>

            <!-- Skills -->
            <div class="mb-6">
                <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">
                    Skills
                </label>
                <input type="text" id="skills" name="skills" value="{{ old('skills', $user->skills) }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('skills') border-red-500 @enderror"
                       placeholder="Enter your skills separated by commas (e.g. PHP, JavaScript, Laravel)">
                @error('skills')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Separate skills with commas</p>
            </div>

            <!-- Experience -->
            <div class="mb-6">
                <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">
                    Work Experience
                </label>
                <textarea id="experience" name="experience" rows="4" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('experience') border-red-500 @enderror"
                          placeholder="Describe your work experience...">{{ old('experience', $user->experience) }}</textarea>
                @error('experience')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Education -->
            <div>
                <label for="education" class="block text-sm font-medium text-gray-700 mb-2">
                    Education
                </label>
                <textarea id="education" name="education" rows="4" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('education') border-red-500 @enderror"
                          placeholder="Describe your educational background...">{{ old('education', $user->education) }}</textarea>
                @error('education')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- File Uploads -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="ri-file-line text-indigo-500"></i>
                File Uploads
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Profile Picture -->
                <div>
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">
                        Profile Picture
                    </label>
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <img id="preview" src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : 'https://via.placeholder.com/64' }}" 
                                 alt="Profile Preview" class="w-16 h-16 object-cover rounded-full">
                        </div>
                        <div class="flex-1">
                            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('profile_picture') border-red-500 @enderror">
                            @error('profile_picture')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Resume -->
                <div>
                    <label for="resume" class="block text-sm font-medium text-gray-700 mb-2">
                        Resume (PDF)
                    </label>
                    <input type="file" id="resume" name="resume" accept=".pdf" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('resume') border-red-500 @enderror">
                    @error('resume')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @if($user->resume)
                        <p class="text-sm text-gray-600 mt-1">
                            Current resume: <a href="{{ asset('storage/'.$user->resume) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">View</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('user.profile') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                Cancel
            </a>
            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200 flex items-center gap-2">
                <i class="ri-save-line"></i>
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
// Profile picture preview
document.getElementById('profile_picture').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Resume file validation
document.getElementById('resume').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const maxSize = 10 * 1024 * 1024; // 10MB
        if (file.size > maxSize) {
            alert('Resume file size must be less than 10MB');
            this.value = '';
            return;
        }
        
        if (file.type !== 'application/pdf') {
            alert('Resume must be a PDF file');
            this.value = '';
            return;
        }
        
        // Show success message
        const message = document.createElement('div');
        message.textContent = 'Resume ready to upload: ' + file.name;
        message.className = 'text-green-600 text-sm mt-1';
        this.parentNode.appendChild(message);
        
        setTimeout(function() {
            message.remove();
        }, 3000);
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const requiredFields = ['name', 'email'];
    let isValid = true;
    
    requiredFields.forEach(function(fieldName) {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (!field.value.trim()) {
            isValid = false;
            field.style.borderColor = '#ef4444';
            
            // Show error message
            let errorMsg = field.parentNode.querySelector('.error-message');
            if (!errorMsg) {
                errorMsg = document.createElement('p');
                errorMsg.className = 'text-red-500 text-sm mt-1 error-message';
                errorMsg.textContent = `${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)} is required`;
                field.parentNode.appendChild(errorMsg);
            }
        } else {
            field.style.borderColor = '';
            const errorMsg = field.parentNode.querySelector('.error-message');
            if (errorMsg) {
                errorMsg.remove();
            }
        }
    });
    
    // Email validation
    const emailField = document.querySelector('[name="email"]');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailField.value && !emailRegex.test(emailField.value)) {
        isValid = false;
        emailField.style.borderColor = '#ef4444';
        
        let errorMsg = emailField.parentNode.querySelector('.error-message');
        if (!errorMsg) {
            errorMsg = document.createElement('p');
            errorMsg.className = 'text-red-500 text-sm mt-1 error-message';
            errorMsg.textContent = 'Please enter a valid email address';
            emailField.parentNode.appendChild(errorMsg);
        }
    }
    
    if (!isValid) {
        e.preventDefault();
        // Scroll to first error
        const firstError = document.querySelector('.error-message');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    } else {
        // Show loading state
        const submitButton = document.querySelector('button[type="submit"]');
        const buttonText = submitButton.innerHTML;
        submitButton.innerHTML = '<i class="ri-loader-4-line animate-spin"></i> Saving...';
        submitButton.disabled = true;
    }
});

// Auto-save draft functionality
let saveTimeout;
document.querySelectorAll('input, textarea').forEach(function(field) {
    field.addEventListener('input', function() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(function() {
            // Save draft to localStorage
            const formData = new FormData(document.querySelector('form'));
            const data = {};
            for (let [key, value] of formData.entries()) {
                if (key !== 'profile_picture' && key !== 'resume') {
                    data[key] = value;
                }
            }
            localStorage.setItem('profile_draft', JSON.stringify(data));
            
            // Show auto-save indicator
            const indicator = document.getElementById('auto-save-indicator') || document.createElement('div');
            indicator.id = 'auto-save-indicator';
            indicator.className = 'fixed top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-lg text-sm z-50';
            indicator.textContent = 'Draft saved';
            document.body.appendChild(indicator);
            
            setTimeout(function() {
                indicator.remove();
            }, 2000);
        }, 2000);
    });
});

// Load draft on page load
document.addEventListener('DOMContentLoaded', function() {
    const draft = localStorage.getItem('profile_draft');
    if (draft) {
        const data = JSON.parse(draft);
        Object.keys(data).forEach(function(key) {
            const field = document.querySelector(`[name="${key}"]`);
            if (field && !field.value) {
                field.value = data[key];
            }
        });
    }
});

// Clear draft on successful submission
window.addEventListener('beforeunload', function() {
    if (document.querySelector('.text-green-800')) {
        localStorage.removeItem('profile_draft');
    }
});
</script>
@endsection
