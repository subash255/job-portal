@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('job.detail', $work->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                <i class="ri-arrow-left-line mr-2"></i>Back to Job Details
            </a>
        </div>

        <!-- Application Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Apply for Position</h1>
                <div class="flex items-center space-x-4 text-gray-600">
                    <span class="text-lg font-medium">{{ $work->title }}</span>
                    <span>•</span>
                    <span>{{ $work->user->name }}</span>
                    <span>•</span>
                    <span>{{ $work->location }}</span>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('work.apply', $work->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Personal Information -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                   required readonly>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                   required readonly>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                   required>
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" id="address" name="address" value="{{ auth()->user()->address }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                   required>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Professional Information</h2>
                    <div class="space-y-6">
                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                            <textarea id="experience" name="experience" rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                      placeholder="Describe your relevant work experience...">{{ auth()->user()->experience }}</textarea>
                            @error('experience')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="education" class="block text-sm font-medium text-gray-700 mb-2">Education</label>
                            <textarea id="education" name="education" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                      placeholder="Describe your educational background...">{{ auth()->user()->education }}</textarea>
                            @error('education')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                            <input type="text" id="skills" name="skills" value="{{ auth()->user()->skills }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                   placeholder="List your relevant skills (comma-separated)">
                            @error('skills')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Cover Letter -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Cover Letter</h2>
                    <textarea id="cover_letter" name="cover_letter" rows="6" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                              placeholder="Write a compelling cover letter explaining why you're the perfect fit for this position..." required></textarea>
                    @error('cover_letter')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Resume Upload -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Resume</h2>
                    @if(auth()->user()->resume)
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="ri-file-text-line text-green-600 text-xl"></i>
                                <div>
                                    <p class="text-green-800 font-medium">Current Resume</p>
                                    <p class="text-green-600 text-sm">Your existing resume will be used for this application</p>
                                </div>
                                <a href="{{ asset('storage/' . auth()->user()->resume) }}" target="_blank" 
                                   class="text-green-600 hover:text-green-800 font-medium">
                                    <i class="ri-eye-line mr-1"></i>View
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="ri-alert-line text-yellow-600 text-xl"></i>
                                <div>
                                    <p class="text-yellow-800 font-medium">No Resume Found</p>
                                    <p class="text-yellow-600 text-sm">Please upload your resume or update your profile</p>
                                </div>
                                <a href="{{ route('user.edit-profile') }}" class="text-yellow-600 hover:text-yellow-800 font-medium">
                                    Update Profile
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    <div>
                        <label for="resume" class="block text-sm font-medium text-gray-700 mb-2">
                            Upload New Resume (Optional)
                        </label>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <p class="text-sm text-gray-500 mt-2">Accepted formats: PDF, DOC, DOCX (Max: 10MB)</p>
                        @error('resume')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="mb-8">
                    <label class="flex items-start space-x-3">
                        <input type="checkbox" name="terms" class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" required>
                        <span class="text-sm text-gray-700">
                            I agree to the <a href="#" class="text-indigo-600 hover:text-indigo-800">Terms and Conditions</a> 
                            and <a href="#" class="text-indigo-600 hover:text-indigo-800">Privacy Policy</a>. 
                            I understand that the information provided will be shared with the employer.
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('job.detail', $work->id) }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold">
                        <i class="ri-send-plane-line mr-2"></i>Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Auto-resize textareas
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
});
</script>
@endsection
