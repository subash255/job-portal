@extends('user.layout')

@section('user-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">My Job Applications</h1>
                <p class="text-gray-600">Track your job applications and their status</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600">Total Applications:</span>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">{{ $appliedJobs->total() }}</span>
            </div>
        </div>
    </div>

    <!-- Filter and Search -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form method="GET" action="{{ route('user.my-jobs') }}" class="flex flex-col md:flex-row gap-4 items-center">
            <div class="flex-1">
                <div class="relative">
                    <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search applications..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
            <div class="flex gap-2">
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Status</option>
                    <option value="applied" {{ request('status') == 'applied' ? 'selected' : '' }}>Applied</option>
                    <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                    <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
                    <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                    <i class="ri-filter-line"></i>
                </button>
                @if(request('search') || request('status'))
                <a href="{{ route('user.my-jobs') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                    Clear
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Applications List -->
    <div class="space-y-6">
        @forelse($appliedJobs as $job)
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-200">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Job Info -->
                <div class="flex-1">
                    <div class="flex items-start gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <img src="https://via.placeholder.com/64" alt="Company Logo" class="w-12 h-12 rounded-lg object-cover">
                        </div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $job->title }}</h3>
                                    <p class="text-gray-600 mb-2">{{ $job->company_name }}</p>
                                    <div class="flex items-center gap-4 text-sm text-gray-500">
                                        <div class="flex items-center gap-1">
                                            <i class="ri-map-pin-line"></i>
                                            <span>{{ $job->location }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="ri-time-line"></i>
                                            <span>{{ $job->job_type }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="ri-money-dollar-box-line"></i>
                                            <span>{{ $job->salary_range }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-2">
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                        Applied
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        Applied {{ $job->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Status -->
                <div class="lg:w-64">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-3">Application Status</h4>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Application Submitted</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Under Review</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                                <span class="text-sm text-gray-400">Interview</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                                <span class="text-sm text-gray-400">Final Decision</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="border-t pt-4 mt-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="ri-calendar-line"></i>
                        <span>Deadline: {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Not specified' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                            View Details
                        </button>
                        <button class="text-red-600 hover:text-red-800 font-medium text-sm">
                            Withdraw Application
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ri-briefcase-line text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">No Applications Yet</h3>
            <p class="text-gray-600 mb-6">You haven't applied to any jobs yet. Start your job search now!</p>
            <a href="{{ route('job') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors duration-200 inline-flex items-center gap-2">
                <i class="ri-search-line"></i>
                Browse Jobs
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($appliedJobs->hasPages())
    <div class="bg-white rounded-xl shadow-lg p-6">
        {{ $appliedJobs->links() }}
    </div>
    @endif
</div>

<script>
// Search functionality with debounce
let searchTimeout;
document.querySelector('input[name="search"]').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(function() {
        // Auto-submit form after user stops typing
        document.querySelector('form').submit();
    }, 500);
});

// Add loading state to filter form
document.querySelector('form').addEventListener('submit', function() {
    const submitButton = document.querySelector('button[type="submit"]');
    const icon = submitButton.querySelector('i');
    
    icon.classList.remove('ri-filter-line');
    icon.classList.add('ri-loader-4-line');
    icon.style.animation = 'spin 1s linear infinite';
    
    submitButton.disabled = true;
});

// Job card interactions
document.querySelectorAll('.bg-white.rounded-xl.shadow-lg').forEach(function(card) {
    // Hover effects
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
        this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
        this.style.transition = 'all 0.3s ease';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = '';
    });
});

// Handle action buttons
document.querySelectorAll('button:contains("View Details"), button:contains("Withdraw Application")').forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const action = this.textContent.trim();
        
        if (action === 'View Details') {
            // Simulate modal opening
            alert('Job details modal would open here');
        } else if (action === 'Withdraw Application') {
            if (confirm('Are you sure you want to withdraw your application?')) {
                // Animate card removal
                const card = this.closest('.bg-white.rounded-xl');
                card.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                card.style.opacity = '0';
                card.style.transform = 'translateX(-20px)';
                
                setTimeout(function() {
                    card.remove();
                    
                    // Update total count
                    const countElement = document.querySelector('.bg-indigo-100');
                    if (countElement) {
                        const currentCount = parseInt(countElement.textContent);
                        countElement.textContent = currentCount - 1;
                    }
                }, 300);
            }
        }
    });
});

// Status progress animation
document.querySelectorAll('.w-3.h-3').forEach(function(dot, index) {
    setTimeout(function() {
        dot.style.transform = 'scale(1.2)';
        dot.style.transition = 'transform 0.2s ease';
        
        setTimeout(function() {
            dot.style.transform = 'scale(1)';
        }, 200);
    }, index * 100);
});

// Add keyboard navigation
document.addEventListener('keydown', function(e) {
    if (e.key === 'f' && e.ctrlKey) {
        e.preventDefault();
        document.querySelector('input[name="search"]').focus();
    }
});

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .animate-spin {
        animation: spin 1s linear infinite;
    }
`;
document.head.appendChild(style);
</script>
@endsection
