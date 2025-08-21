@extends('user.layout')

@section('user-content')

<style>
    /* Modal styles */
    .modal-hidden {
        display: none !important;
        opacity: 0;
        visibility: hidden;
    }
    .modal-visible {
        display: flex !important;
        opacity: 1;
        visibility: visible;
    }
    .modal-backdrop {
        backdrop-filter: blur(4px);
        transition: opacity 0.3s ease-in-out;
    }
    .modal-content {
        transform: scale(0.95);
        transition: transform 0.3s ease-in-out;
    }
    .modal-visible .modal-content {
        transform: scale(1);
    }
</style>

 {{-- Flash Message --}}
    @if (session('success'))
        <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    <script>
        if (document.getElementById('flash-message')) setTimeout(() => {
            const msg = document.getElementById('flash-message');
            msg.style.opacity = 0;
            msg.style.transition = "opacity 0.5s ease-out";
            setTimeout(() => msg.remove(), 500);
        }, 3000);
    </script>
<div class="space-y-8">
    <!-- Profile Header -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
            <a href="{{ route('user.edit-profile') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200 flex items-center gap-2">
                <i class="ri-edit-line"></i>
                Edit Profile
            </a>
        </div>

        <!-- Profile Picture and Basic Info -->
        <div class="flex flex-col md:flex-row gap-8">
            <div class="text-center md:text-left">
                <div class="relative inline-block">
                    <img src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : 'https://via.placeholder.com/150' }}" 
                         alt="Profile Picture" 
                         class="w-32 h-32 rounded-full object-cover ring-4 ring-indigo-100 shadow-lg">
                    <div class="absolute bottom-2 right-2 w-8 h-8 bg-green-500 rounded-full ring-2 ring-white flex items-center justify-center">
                        <i class="ri-check-line text-white text-sm"></i>
                    </div>
                </div>
            </div>

            <div class="flex-1">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $user->name }}</h2>
                <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center gap-2 text-gray-600">
                        <i class="ri-phone-line text-indigo-500"></i>
                        <span>{{ $user->phone ?: 'Not provided' }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <i class="ri-map-pin-line text-indigo-500"></i>
                        <span>{{ $user->address ?: 'Not provided' }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <i class="ri-calendar-line text-indigo-500"></i>
                        <span>Member since {{ $user->created_at->format('M Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <i class="ri-user-line text-indigo-500"></i>
                        <span class="capitalize">{{ $user->role }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- About Me -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="ri-user-3-line text-indigo-500"></i>
                About Me
            </h3>
            <div class="text-gray-600 leading-relaxed">
                @if($user->bio)
                    <p>{{ $user->bio }}</p>
                @else
                    <div class="text-center py-8 text-gray-400">
                        <i class="ri-user-line text-4xl mb-2"></i>
                        <p>No bio added yet</p>
                        <a href="{{ route('user.edit-profile') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Add Bio</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Skills -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="ri-lightbulb-line text-indigo-500"></i>
                Skills
            </h3>
            @if($user->skills)
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $user->skills) as $skill)
                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ trim($skill) }}
                        </span>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="ri-lightbulb-line text-4xl mb-2"></i>
                    <p>No skills added yet</p>
                    <a href="{{ route('user.edit-profile') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Add Skills</a>
                </div>
            @endif
        </div>

        <!-- Experience -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="ri-briefcase-line text-indigo-500"></i>
                Experience
            </h3>
            @if($user->experience)
                <div class="text-gray-600 leading-relaxed">
                    <p>{{ $user->experience }}</p>
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="ri-briefcase-line text-4xl mb-2"></i>
                    <p>No experience added yet</p>
                    <a href="{{ route('user.edit-profile') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Add Experience</a>
                </div>
            @endif
        </div>

        <!-- Education -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="ri-graduation-cap-line text-indigo-500"></i>
                Education
            </h3>
            @if($user->education)
                <div class="text-gray-600 leading-relaxed">
                    <p>{{ $user->education }}</p>
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="ri-graduation-cap-line text-4xl mb-2"></i>
                    <p>No education added yet</p>
                    <a href="{{ route('user.edit-profile') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Add Education</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Resume Section -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <i class="ri-file-text-line text-indigo-500"></i>
            Resume
        </h3>
        @if($user->resume)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="ri-file-pdf-line text-2xl text-red-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Resume.pdf</p>
                        <p class="text-sm text-gray-600">Uploaded {{ $user->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ asset('storage/'.$user->resume) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 font-medium">
                        <i class="ri-eye-line"></i> 
                    </a>
                    <button type="button" 
                            onclick="confirmDeleteResume()"
                            class="text-red-600 hover:text-red-800 font-medium">
                        <i class="ri-delete-bin-line"></i> 
                    </button>
                </div>
            </div>
        @else
            <div class="text-center py-8 text-gray-400">
                <i class="ri-file-text-line text-4xl mb-2"></i>
                <p>No resume uploaded yet</p>
                <a href="{{ route('user.edit-profile') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Upload Resume</a>
            </div>
        @endif
    </div>
</div>

<script>
    // Resume delete modal functions
    function confirmDeleteResume() {
        console.log('confirmDeleteResume called'); // Debug log
        try {
            const modal = document.getElementById('deleteResumeModal');
            console.log('Modal element:', modal); // Debug log
            if (modal) {
                console.log('Modal found, showing...'); // Debug log
                modal.classList.remove('modal-hidden');
                modal.classList.add('modal-visible');
                document.body.style.overflow = 'hidden';
                console.log('Modal should be visible now'); // Debug log
            } else {
                console.error('Modal element not found!');
                // Fallback to browser confirm
                if (confirm('Are you sure you want to delete your resume? This action cannot be undone.')) {
                    const form = document.getElementById('deleteResumeForm');
                    if (form) {
                        form.submit();
                    }
                }
            }
        } catch (error) {
            console.error('Error opening delete resume modal:', error);
            // Fallback to browser confirm
            if (confirm('Are you sure you want to delete your resume? This action cannot be undone.')) {
                const form = document.getElementById('deleteResumeForm');
                if (form) {
                    form.submit();
                }
            }
        }
    }

    function closeDeleteResumeModal() {
        try {
            const modal = document.getElementById('deleteResumeModal');
            if (modal) {
                modal.classList.add('modal-hidden');
                modal.classList.remove('modal-visible');
                document.body.style.overflow = '';
            }
        } catch (error) {
            console.error('Error closing delete resume modal:', error);
        }
    }

    // Document ready functions
    document.addEventListener('DOMContentLoaded', function() {
        // Modal event listeners
        const deleteResumeModal = document.getElementById('deleteResumeModal');
        if (deleteResumeModal) {
            // Close modal when clicking outside
            deleteResumeModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDeleteResumeModal();
                }
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('deleteResumeModal');
                if (modal && modal.classList.contains('modal-visible')) {
                    closeDeleteResumeModal();
                }
            }
        });

        // Add smooth scrolling to profile sections
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add hover effect to profile cards
        document.querySelectorAll('.bg-white.rounded-xl').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.1)';
                this.style.transition = 'all 0.3s ease';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });

        // Add loading state to edit profile button
        const editProfileBtn = document.querySelector('a[href*="edit-profile"]');
        if (editProfileBtn) {
            editProfileBtn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon) {
                    icon.classList.remove('ri-edit-line');
                    icon.classList.add('ri-loader-4-line');
                    icon.style.animation = 'spin 1s linear infinite';
                }
            });
        }

        // Add click-to-copy functionality for email (if email exists)
        const emailElement = document.querySelector('p.text-gray-600');
        if (emailElement && emailElement.textContent.includes('@')) {
            emailElement.style.cursor = 'pointer';
            emailElement.title = 'Click to copy email';
            emailElement.addEventListener('click', function() {
                const email = '{{ $user->email }}';
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(email).then(function() {
                        // Show temporary success message
                        const message = document.createElement('div');
                        message.textContent = 'Email copied to clipboard!';
                        message.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg z-50';
                        document.body.appendChild(message);
                        
                        setTimeout(function() {
                            if (message.parentNode) {
                                message.parentNode.removeChild(message);
                            }
                        }, 3000);
                    }).catch(function(err) {
                        console.error('Could not copy email: ', err);
                    });
                }
            });
        }
    });
</script>

<!-- Delete Resume Confirmation Modal -->
<div id="deleteResumeModal" class="fixed inset-0 bg-black bg-opacity-50 modal-hidden items-center justify-center z-50 modal-backdrop">
    <div class="modal-content bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="ri-delete-bin-line text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Delete Resume</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone</p>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="mb-6">
                <p class="text-gray-700 mb-4">
                    Are you sure you want to delete your resume? This will permanently remove your uploaded resume file.
                </p>
                
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="ri-file-pdf-line text-red-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Resume.pdf</h4>
                            <p class="text-sm text-gray-600">Your current resume file</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start space-x-2">
                        <i class="ri-warning-line text-yellow-600 mt-0.5"></i>
                        <div class="text-sm text-yellow-800">
                            <p class="font-medium">Warning:</p>
                            <ul class="mt-1 space-y-1 text-xs">
                                <li>• Your resume will be permanently deleted</li>
                                <li>• You won't be able to apply for jobs without a resume</li>
                                <li>• You'll need to upload a new resume to continue applying</li>
                                <li>• This action cannot be reversed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="flex space-x-3 justify-end">
                <button type="button" 
                        onclick="closeDeleteResumeModal()"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    <i class="ri-close-line mr-1"></i>
                    Cancel
                </button>
                <form id="deleteResumeForm" action="{{ route('user.delete-resume') }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                        <i class="ri-delete-bin-line mr-1"></i>
                        Delete Resume
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
