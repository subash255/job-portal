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
    
    /* Mobile responsive adjustments */
    @media (max-width: 640px) {
        .job-card {
            padding: 1rem !important;
        }
        .job-details {
            flex-direction: column;
            align-items: flex-start !important;
        }
        .job-meta {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .job-meta span {
            font-size: 0.75rem;
        }
        .search-filters {
            flex-direction: column;
            gap: 0.75rem;
        }
        .filter-buttons {
            flex-direction: column;
            width: 100%;
        }
        .filter-buttons > * {
            width: 100%;
        }
    }
</style>

<div class="max-w-6xl mx-auto px-2 sm:px-4 py-4 sm:py-8">
    <!-- Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">My Applications</h1>
                <p class="text-gray-600 mt-1 text-sm sm:text-base">Track your job applications and their status</p>
            </div>
            <div class="bg-blue-50 px-3 sm:px-4 py-2 rounded-lg self-start sm:self-auto">
                <span class="text-sm text-blue-600 font-medium">{{ $appliedJobs->total() }} Applications</span>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-4 sm:mb-6 bg-green-50 border border-green-200 text-green-800 px-3 sm:px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="ri-check-circle-line mr-2"></i>
                <span class="text-sm sm:text-base">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 sm:mb-6 bg-red-50 border border-red-200 text-red-800 px-3 sm:px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="ri-error-warning-line mr-2"></i>
                <span class="text-sm sm:text-base">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Search & Filter -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4 sm:mb-6">
        <div class="p-3 sm:p-4">
            <form method="GET" action="{{ route('user.my-jobs') }}" class="search-filters flex flex-col sm:flex-row gap-3 sm:gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm sm:text-base"></i>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search by job title or company..." 
                               class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                    </div>
                </div>
                <div class="filter-buttons flex flex-col sm:flex-row gap-2 sm:gap-3">
                    <select name="status" class="px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        <option value="">All Status</option>
                        <option value="applied" {{ request('status') == 'applied' ? 'selected' : '' }}>Applied</option>
                        <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
                        <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="px-3 sm:px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm sm:text-base">
                        <i class="ri-filter-line mr-1 sm:mr-0"></i>
                        <span class="sm:hidden">Filter</span>
                    </button>
                    @if(request('search') || request('status'))
                    <a href="{{ route('user.my-jobs') }}" class="px-3 sm:px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-center text-sm sm:text-base">
                        <span class="sm:hidden">Clear Filters</span>
                        <span class="hidden sm:inline">Clear</span>
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Applications List -->
    <div class="space-y-3 sm:space-y-4">
        @forelse($appliedJobs as $job)
        <div class="job-card bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow p-4 sm:p-6">
            <div class="job-details flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <!-- Job Details -->
                <div class="flex items-start space-x-3 sm:space-x-4 flex-1">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        @if($job->work->user->profile_picture)
                            <img src="{{ asset('storage/' . $job->work->user->profile_picture) }}" alt="Company Logo" class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg object-cover">
                        @else
                            <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                <i class="ri-building-line text-white text-sm sm:text-base"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 truncate">{{ $job->work->title }}</h3>
                                <p class="text-gray-600 text-sm">{{ $job->work->user->name }}</p>
                                <div class="job-meta flex flex-wrap items-center gap-2 sm:gap-4 mt-2 text-xs sm:text-sm text-gray-500">
                                    <span class="flex items-center space-x-1">
                                        <i class="ri-map-pin-line text-xs sm:text-sm"></i>
                                        <span>{{ $job->work->location }}</span>
                                    </span>
                                    <span class="flex items-center space-x-1">
                                        <i class="ri-time-line text-xs sm:text-sm"></i>
                                        <span>{{ $job->work->type }}</span>
                                    </span>
                                    <span class="flex items-center space-x-1">
                                        <i class="ri-money-dollar-circle-line text-xs sm:text-sm"></i>
                                        <span>{{ $job->work->salary ?: 'Negotiable' }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-row sm:flex-col items-start sm:items-end space-x-2 sm:space-x-0 sm:space-y-2 mt-2 sm:mt-0">
                                @php
                                    $statusColors = [
                                        'applied' => 'bg-blue-100 text-blue-800',
                                        'under_review' => 'bg-yellow-100 text-yellow-800',
                                        'interview' => 'bg-purple-100 text-purple-800',
                                        'hired' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusIcons = [
                                        'applied' => 'ri-send-plane-line',
                                        'under_review' => 'ri-time-line',
                                        'interview' => 'ri-user-voice-line',
                                        'hired' => 'ri-check-circle-line',
                                        'rejected' => 'ri-close-circle-line',
                                    ];
                                    $currentStatus = $job->status ?? 'applied';
                                    $statusClass = $statusColors[$currentStatus] ?? 'bg-gray-100 text-gray-800';
                                    $statusIcon = $statusIcons[$currentStatus] ?? 'ri-question-line';
                                @endphp
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                    <i class="{{ $statusIcon }} mr-1"></i>
                                    <span class="hidden sm:inline">{{ ucfirst(str_replace('_', ' ', $currentStatus)) }}</span>
                                    <span class="sm:hidden">{{ ucfirst(substr(str_replace('_', ' ', $currentStatus), 0, 8)) }}</span>
                                </span>
                                <span class="text-xs text-gray-500 whitespace-nowrap">{{ $job->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
                <!-- Application Status & Actions -->
                <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-0">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6">
                            <div class="text-xs sm:text-sm text-gray-600">
                                <span class="font-medium">Status:</span>
                                @php
                                    $statusColors = [
                                        'applied' => 'bg-blue-100 text-blue-800',
                                        'under_review' => 'bg-yellow-100 text-yellow-800',
                                        'interview' => 'bg-purple-100 text-purple-800',
                                        'hired' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                    ];
                                    $currentStatus = $job->status ?? 'applied';
                                    $statusClass = $statusColors[$currentStatus] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="ml-1 px-2 py-1 rounded text-xs {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $currentStatus)) }}
                                </span>
                            </div>
                            <div class="text-xs sm:text-sm text-gray-600">
                                <span class="font-medium">Applied:</span>
                                <span class="ml-1">{{ ($job->applied_at ?? $job->created_at)->format('M d, Y') }}</span>
                            </div>
                            @if($job->work->end_date)
                            <div class="text-xs sm:text-sm text-gray-600">
                                <span class="font-medium">Deadline:</span>
                                <span class="ml-1">{{ $job->work->end_date->format('M d, Y') }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-2 justify-start sm:justify-end">
                            <button type="button" 
                                    onclick="viewApplicationDetails({{ $job->id }})"
                                    class="inline-flex items-center px-3 py-1.5 sm:py-1 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 text-xs sm:text-sm font-medium transition-colors">
                                <i class="ri-eye-line mr-1"></i>
                                View Details
                            </button>
                            @if($job->status === 'applied' || $job->status === 'interview')
                            <button type="button" 
                                    onclick="confirmWithdraw({{ $job->id }}, '{{ $job->work->title }}', '{{ $job->work->user->name }}')"
                                    class="inline-flex items-center px-3 py-1.5 sm:py-1 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 text-xs sm:text-sm font-medium transition-colors">
                                <i class="ri-close-circle-line mr-1"></i>
                                Withdraw
                            </button>
                            @else
                            <div class="text-xs sm:text-sm text-gray-500 italic">
                                Application {{ $job->status === 'rejected' ? 'was rejected' : 'is finalized' }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Hidden data for modal (JSON) -->
                <div class="hidden" id="job-data-{{ $job->id }}" 
                     data-job-title="{{ $job->work->title }}"
                     data-company-name="{{ $job->work->user->name }}"
                     data-company-email="{{ $job->work->user->email ?? 'N/A' }}"
                     data-location="{{ $job->work->location }}"
                     data-salary="{{ $job->work->salary ?: 'Negotiable' }}"
                     data-type="{{ $job->work->type }}"
                     data-category="{{ $job->work->category->name ?? 'N/A' }}"
                     data-description="{{ strip_tags($job->work->description) }}"
                     data-responsibilities="{{ strip_tags($job->work->responsibility) }}"
                     data-requirements="{{ strip_tags($job->work->expected_requirement) }}"
                     data-benefits="{{ strip_tags($job->work->benefits) }}"
                     data-end-date="{{ $job->work->end_date ? $job->work->end_date->format('M d, Y') : 'N/A' }}"
                     data-status="{{ $job->status }}"
                     data-applied-date="{{ ($job->applied_at ?? $job->created_at)->format('M d, Y h:i A') }}"
                     data-phone="{{ $job->phone ?? 'N/A' }}"
                     data-address="{{ $job->address ?? 'N/A' }}"
                     data-experience="{{ $job->experience ?? 'N/A' }}"
                     data-education="{{ $job->education ?? 'N/A' }}"
                     data-skills="{{ $job->skills ?? 'N/A' }}"
                     data-cover-letter="{{ $job->cover_letter ?? 'N/A' }}"
                     data-resume="{{ $job->resume ? asset('storage/' . $job->resume) : '' }}"
                     data-portfolio="{{ $job->portfolio_url ?? '' }}"
                     data-expected-salary="{{ $job->expected_salary ?? 'N/A' }}"
                     data-availability="{{ $job->availability_date ? \Carbon\Carbon::parse($job->availability_date)->format('M d, Y') : 'N/A' }}"
                     data-interview-type="{{ $job->interview && $job->interview->meet_link ? 'online' : 'walk-in' }}"
                     data-interview-link="{{ $job->interview && $job->interview->meet_link ? $job->interview->meet_link : '' }}"
                     data-interview-date="{{ $job->interview && $job->interview->scheduled_at ? \Carbon\Carbon::parse($job->interview->scheduled_at)->format('M d, Y h:i A') : '' }}">
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8 sm:py-12">
            <div class="w-16 h-16 sm:w-24 sm:h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ri-briefcase-line text-2xl sm:text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">No Applications Yet</h3>
            <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base px-4">You haven't applied to any jobs yet. Start your job search now!</p>
            <a href="{{ route('welcome') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm sm:text-base">
                <i class="ri-search-line mr-2"></i>
                Browse Jobs
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($appliedJobs->hasPages())
    <div class="mt-4 sm:mt-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3 sm:p-4">
            {{ $appliedJobs->links() }}
        </div>
    </div>
    @endif
</div>

<!-- View Application Details Modal -->
<div id="viewDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 modal-hidden items-center justify-center z-50 modal-backdrop px-4 overflow-y-auto py-8">
    <div class="modal-content bg-white rounded-lg shadow-xl max-w-4xl w-full my-8">
        <div class="p-4 sm:p-6">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-4 sm:mb-6 border-b pb-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-full flex items-center justify-center mr-3 sm:mr-4">
                        <i class="ri-file-text-line text-blue-600 text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">Application Details</h3>
                        <p class="text-xs sm:text-sm text-gray-500">Complete application and job information</p>
                    </div>
                </div>
                <button type="button" 
                        onclick="closeViewDetailsModal()"
                        class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="space-y-6 max-h-[70vh] overflow-y-auto">
                <!-- Job Information Section -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 sm:p-5 border border-blue-100">
                    <h4 class="text-base sm:text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="ri-briefcase-line mr-2 text-blue-600"></i>
                        Job Information
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Job Title</label>
                            <p id="detailJobTitle" class="text-sm sm:text-base text-gray-900 font-medium mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Company</label>
                            <p id="detailCompanyName" class="text-sm sm:text-base text-gray-900 font-medium mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Location</label>
                            <p id="detailLocation" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Job Type</label>
                            <p id="detailType" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Salary</label>
                            <p id="detailSalary" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Category</label>
                            <p id="detailCategory" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Application Deadline</label>
                            <p id="detailEndDate" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Company Email</label>
                            <p id="detailCompanyEmail" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                    </div>
                    
                    <div class="mt-4" id="detailDescriptionContainer">
                        <label class="text-xs font-medium text-gray-500 uppercase">Job Description</label>
                        <p id="detailDescription" class="text-sm text-gray-700 mt-1 leading-relaxed">-</p>
                    </div>
                    
                    <div class="mt-4" id="detailResponsibilitiesContainer">
                        <label class="text-xs font-medium text-gray-500 uppercase">Responsibilities</label>
                        <p id="detailResponsibilities" class="text-sm text-gray-700 mt-1 leading-relaxed whitespace-pre-line">-</p>
                    </div>
                    
                    <div class="mt-4" id="detailRequirementsContainer">
                        <label class="text-xs font-medium text-gray-500 uppercase">Requirements</label>
                        <p id="detailRequirements" class="text-sm text-gray-700 mt-1 leading-relaxed whitespace-pre-line">-</p>
                    </div>
                    
                    <div class="mt-4" id="detailBenefitsContainer">
                        <label class="text-xs font-medium text-gray-500 uppercase">Benefits</label>
                        <p id="detailBenefits" class="text-sm text-gray-700 mt-1 leading-relaxed whitespace-pre-line">-</p>
                    </div>
                </div>

                <!-- Application Status Section -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-4 sm:p-5 border border-purple-100">
                    <h4 class="text-base sm:text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="ri-file-list-line mr-2 text-purple-600"></i>
                        Application Status
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Current Status</label>
                            <p id="detailStatus" class="text-sm sm:text-base mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Applied On</label>
                            <p id="detailAppliedDate" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                    </div>
                    
                    <!-- Interview Details (Only shown when status is interview) -->
                    <div id="interviewDetailsContainer" class="hidden mt-4 pt-4 border-t border-purple-200">
                        <h5 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                            <i class="ri-calendar-event-line mr-2 text-purple-600"></i>
                            Interview Details
                        </h5>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase">Interview Type</label>
                                <p id="interviewType" class="text-sm sm:text-base text-gray-900 mt-1 font-medium">-</p>
                            </div>
                            <div id="interviewDateContainer">
                                <label class="text-xs font-medium text-gray-500 uppercase">Scheduled Date & Time</label>
                                <p id="interviewDate" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                            </div>
                        </div>
                        <div id="interviewLinkContainer" class="hidden mt-4">
                            <a id="interviewLink" href="#" target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-colors text-sm font-medium">
                                <i class="ri-video-chat-line mr-2"></i>
                                Join Online Interview
                            </a>
                        </div>
                        <div id="walkInMessageContainer" class="hidden mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <div class="flex items-start space-x-2">
                                <i class="ri-information-line text-yellow-600 mt-0.5"></i>
                                <div class="text-xs sm:text-sm text-yellow-800">
                                    <p class="font-medium">Walk-in Interview</p>
                                    <p class="mt-1">Please visit the company office for your interview. Check your email for detailed instructions and address.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Your Application Details Section -->
                <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-lg p-4 sm:p-5 border border-green-100">
                    <h4 class="text-base sm:text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="ri-user-line mr-2 text-green-600"></i>
                        Your Application Details
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Phone</label>
                            <p id="detailPhone" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Address</label>
                            <p id="detailAddress" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Expected Salary</label>
                            <p id="detailExpectedSalary" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Availability Date</label>
                            <p id="detailAvailability" class="text-sm sm:text-base text-gray-900 mt-1">-</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="text-xs font-medium text-gray-500 uppercase">Education</label>
                        <p id="detailEducation" class="text-sm text-gray-700 mt-1 leading-relaxed whitespace-pre-line">-</p>
                    </div>
                    
                    <div class="mt-4">
                        <label class="text-xs font-medium text-gray-500 uppercase">Experience</label>
                        <p id="detailExperience" class="text-sm text-gray-700 mt-1 leading-relaxed whitespace-pre-line">-</p>
                    </div>
                    
                    <div class="mt-4">
                        <label class="text-xs font-medium text-gray-500 uppercase">Skills</label>
                        <p id="detailSkills" class="text-sm text-gray-700 mt-1">-</p>
                    </div>
                    
                    <div class="mt-4">
                        <label class="text-xs font-medium text-gray-500 uppercase">Cover Letter</label>
                        <p id="detailCoverLetter" class="text-sm text-gray-700 mt-1 leading-relaxed whitespace-pre-line">-</p>
                    </div>
                    
                    <div class="mt-4 flex flex-col sm:flex-row gap-3">
                        <div id="detailResumeContainer" class="hidden">
                            <a id="detailResumeLink" href="#" target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                <i class="ri-file-download-line mr-2"></i>
                                View Resume
                            </a>
                        </div>
                        <div id="detailPortfolioContainer" class="hidden">
                            <a id="detailPortfolioLink" href="#" target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm">
                                <i class="ri-link mr-2"></i>
                                View Portfolio
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="mt-6 pt-4 border-t flex justify-end">
                <button type="button" 
                        onclick="closeViewDetailsModal()"
                        class="px-4 sm:px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm sm:text-base">
                    <i class="ri-close-line mr-1"></i>
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Withdraw Application Confirmation Modal -->
<div id="withdrawModal" class="fixed inset-0 bg-black bg-opacity-50 modal-hidden items-center justify-center z-50 modal-backdrop px-4">
    <div class="modal-content bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="p-4 sm:p-6">
            <!-- Modal Header -->
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-100 rounded-full flex items-center justify-center mr-3 sm:mr-4">
                    <i class="ri-error-warning-line text-red-600 text-lg sm:text-xl"></i>
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Withdraw Application</h3>
                    <p class="text-xs sm:text-sm text-gray-500">This action cannot be undone</p>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="mb-4 sm:mb-6">
                <p class="text-gray-700 mb-3 sm:mb-4 text-sm sm:text-base">
                    Are you sure you want to withdraw your application for:
                </p>
                <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="ri-briefcase-line text-blue-600 text-sm sm:text-base"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 id="modalJobTitle" class="font-semibold text-gray-900 text-sm sm:text-base truncate">Job Title</h4>
                            <p id="modalCompanyName" class="text-xs sm:text-sm text-gray-600 truncate">Company Name</p>
                        </div>
                    </div>
                </div>
                <div class="mt-3 sm:mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3 sm:p-4">
                    <div class="flex items-start space-x-2">
                        <i class="ri-information-line text-yellow-600 mt-0.5 text-sm sm:text-base"></i>
                        <div class="text-xs sm:text-sm text-yellow-800">
                            <p class="font-medium">Important:</p>
                            <ul class="mt-1 space-y-1 text-xs">
                                <li>• You will lose your place in the application queue</li>
                                <li>• Your application status will be permanently removed</li>
                                <li>• You can reapply later if the position is still open</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3 sm:justify-end">
                <button type="button" 
                        onclick="closeWithdrawModal()"
                        class="w-full sm:w-auto px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm sm:text-base">
                    <i class="ri-close-line mr-1"></i>
                    Cancel
                </button>
                <form id="withdrawForm" method="POST" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium text-sm sm:text-base">
                        <i class="ri-delete-bin-line mr-1"></i>
                        Withdraw Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // View Application Details Modal
    function viewApplicationDetails(applicationId) {
        try {
            const jobData = document.getElementById(`job-data-${applicationId}`);
            
            if (!jobData) {
                console.error('Job data not found');
                return;
            }
            
            // Populate job information
            document.getElementById('detailJobTitle').textContent = jobData.dataset.jobTitle || '-';
            document.getElementById('detailCompanyName').textContent = jobData.dataset.companyName || '-';
            document.getElementById('detailCompanyEmail').textContent = jobData.dataset.companyEmail || '-';
            document.getElementById('detailLocation').textContent = jobData.dataset.location || '-';
            document.getElementById('detailSalary').textContent = jobData.dataset.salary || '-';
            document.getElementById('detailType').textContent = jobData.dataset.type || '-';
            document.getElementById('detailCategory').textContent = jobData.dataset.category || '-';
            document.getElementById('detailEndDate').textContent = jobData.dataset.endDate || '-';
            
            // Populate descriptions (show/hide containers based on content)
            const description = jobData.dataset.description;
            if (description && description !== 'N/A' && description.trim() !== '') {
                document.getElementById('detailDescription').textContent = description;
                document.getElementById('detailDescriptionContainer').classList.remove('hidden');
            } else {
                document.getElementById('detailDescriptionContainer').classList.add('hidden');
            }
            
            const responsibilities = jobData.dataset.responsibilities;
            if (responsibilities && responsibilities !== 'N/A' && responsibilities.trim() !== '') {
                document.getElementById('detailResponsibilities').textContent = responsibilities;
                document.getElementById('detailResponsibilitiesContainer').classList.remove('hidden');
            } else {
                document.getElementById('detailResponsibilitiesContainer').classList.add('hidden');
            }
            
            const requirements = jobData.dataset.requirements;
            if (requirements && requirements !== 'N/A' && requirements.trim() !== '') {
                document.getElementById('detailRequirements').textContent = requirements;
                document.getElementById('detailRequirementsContainer').classList.remove('hidden');
            } else {
                document.getElementById('detailRequirementsContainer').classList.add('hidden');
            }
            
            const benefits = jobData.dataset.benefits;
            if (benefits && benefits !== 'N/A' && benefits.trim() !== '') {
                document.getElementById('detailBenefits').textContent = benefits;
                document.getElementById('detailBenefitsContainer').classList.remove('hidden');
            } else {
                document.getElementById('detailBenefitsContainer').classList.add('hidden');
            }
            
            // Populate application status with badge
            const status = jobData.dataset.status;
            const statusColors = {
                'applied': 'bg-blue-100 text-blue-800',
                'under_review': 'bg-yellow-100 text-yellow-800',
                'interview': 'bg-purple-100 text-purple-800',
                'hired': 'bg-green-100 text-green-800',
                'rejected': 'bg-red-100 text-red-800',
            };
            const statusClass = statusColors[status] || 'bg-gray-100 text-gray-800';
            const statusText = status ? status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase()) : 'Applied';
            document.getElementById('detailStatus').innerHTML = `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${statusClass}">${statusText}</span>`;
            
            document.getElementById('detailAppliedDate').textContent = jobData.dataset.appliedDate || '-';
            
            // Handle Interview Details (only show if status is interview)
            const interviewDetailsContainer = document.getElementById('interviewDetailsContainer');
            if (status === 'interview') {
                interviewDetailsContainer.classList.remove('hidden');
                
                const interviewType = jobData.dataset.interviewType;
                const interviewLink = jobData.dataset.interviewLink;
                const interviewDate = jobData.dataset.interviewDate;
                
                // Set interview type with icon
                const interviewTypeElement = document.getElementById('interviewType');
                if (interviewType === 'online') {
                    interviewTypeElement.innerHTML = '<span class="inline-flex items-center text-blue-700"><i class="ri-video-chat-line mr-1"></i>Online Interview (Google Meet)</span>';
                } else {
                    interviewTypeElement.innerHTML = '<span class="inline-flex items-center text-orange-700"><i class="ri-map-pin-user-line mr-1"></i>Walk-in Interview</span>';
                }
                
                // Set interview date
                const interviewDateContainer = document.getElementById('interviewDateContainer');
                const interviewDateElement = document.getElementById('interviewDate');
                if (interviewDate && interviewDate.trim() !== '') {
                    interviewDateElement.textContent = interviewDate;
                    interviewDateContainer.classList.remove('hidden');
                } else {
                    interviewDateContainer.classList.add('hidden');
                }
                
                // Show/hide interview link or walk-in message
                const interviewLinkContainer = document.getElementById('interviewLinkContainer');
                const walkInMessageContainer = document.getElementById('walkInMessageContainer');
                
                if (interviewType === 'online' && interviewLink && interviewLink.trim() !== '') {
                    document.getElementById('interviewLink').href = interviewLink;
                    interviewLinkContainer.classList.remove('hidden');
                    walkInMessageContainer.classList.add('hidden');
                } else if (interviewType === 'walk-in') {
                    interviewLinkContainer.classList.add('hidden');
                    walkInMessageContainer.classList.remove('hidden');
                } else {
                    interviewLinkContainer.classList.add('hidden');
                    walkInMessageContainer.classList.add('hidden');
                }
            } else {
                interviewDetailsContainer.classList.add('hidden');
            }
            
            // Populate your application details
            document.getElementById('detailPhone').textContent = jobData.dataset.phone || '-';
            document.getElementById('detailAddress').textContent = jobData.dataset.address || '-';
            document.getElementById('detailEducation').textContent = jobData.dataset.education || '-';
            document.getElementById('detailExperience').textContent = jobData.dataset.experience || '-';
            document.getElementById('detailSkills').textContent = jobData.dataset.skills || '-';
            document.getElementById('detailCoverLetter').textContent = jobData.dataset.coverLetter || '-';
            document.getElementById('detailExpectedSalary').textContent = jobData.dataset.expectedSalary || '-';
            document.getElementById('detailAvailability').textContent = jobData.dataset.availability || '-';
            
            // Handle resume link
            const resumeUrl = jobData.dataset.resume;
            const resumeContainer = document.getElementById('detailResumeContainer');
            const resumeLink = document.getElementById('detailResumeLink');
            if (resumeUrl && resumeUrl.trim() !== '') {
                resumeLink.href = resumeUrl;
                resumeContainer.classList.remove('hidden');
            } else {
                resumeContainer.classList.add('hidden');
            }
            
            // Handle portfolio link
            const portfolioUrl = jobData.dataset.portfolio;
            const portfolioContainer = document.getElementById('detailPortfolioContainer');
            const portfolioLink = document.getElementById('detailPortfolioLink');
            if (portfolioUrl && portfolioUrl.trim() !== '') {
                portfolioLink.href = portfolioUrl;
                portfolioContainer.classList.remove('hidden');
            } else {
                portfolioContainer.classList.add('hidden');
            }
            
            // Show modal
            const modal = document.getElementById('viewDetailsModal');
            if (modal) {
                modal.classList.remove('modal-hidden');
                modal.classList.add('modal-visible');
                document.body.style.overflow = 'hidden';
            }
        } catch (error) {
            console.error('Error viewing application details:', error);
            alert('Error loading application details. Please try again.');
        }
    }
    
    function closeViewDetailsModal() {
        try {
            const modal = document.getElementById('viewDetailsModal');
            if (modal) {
                modal.classList.add('modal-hidden');
                modal.classList.remove('modal-visible');
            }
            document.body.style.overflow = '';
        } catch (error) {
            console.error('Error closing view details modal:', error);
        }
    }

    // Modal functions
    function confirmWithdraw(applicationId, jobTitle, companyName) {
        try {
            // Set the form action
            const withdrawUrl = "{{ route('user.withdraw-application', ':id') }}".replace(':id', applicationId);
            const withdrawForm = document.getElementById('withdrawForm');
            
            if (!withdrawForm) {
                console.error('Withdraw form not found');
                return;
            }
            
            withdrawForm.action = withdrawUrl;
            
            // Update modal content
            const modalJobTitle = document.getElementById('modalJobTitle');
            const modalCompanyName = document.getElementById('modalCompanyName');
            
            if (modalJobTitle) modalJobTitle.textContent = jobTitle;
            if (modalCompanyName) modalCompanyName.textContent = companyName;
            
            // Show modal
            const modal = document.getElementById('withdrawModal');
            if (modal) {
                modal.classList.remove('modal-hidden');
                modal.classList.add('modal-visible');
                
                // Prevent body scrolling
                document.body.style.overflow = 'hidden';
            }
        } catch (error) {
            console.error('Error opening withdraw modal:', error);
            // Fallback to browser confirm
            if (confirm('Are you sure you want to withdraw this application?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('user.withdraw-application', ':id') }}".replace(':id', applicationId);
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    }

    function closeWithdrawModal() {
        try {
            const modal = document.getElementById('withdrawModal');
            if (modal) {
                modal.classList.add('modal-hidden');
                modal.classList.remove('modal-visible');
            }
            
            // Restore body scrolling
            document.body.style.overflow = '';
        } catch (error) {
            console.error('Error closing withdraw modal:', error);
        }
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Close modals when clicking outside
        const withdrawModal = document.getElementById('withdrawModal');
        const viewDetailsModal = document.getElementById('viewDetailsModal');
        
        if (withdrawModal) {
            withdrawModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeWithdrawModal();
                }
            });
        }
        
        if (viewDetailsModal) {
            viewDetailsModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeViewDetailsModal();
                }
            });
        }

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (withdrawModal && withdrawModal.classList.contains('modal-visible')) {
                    closeWithdrawModal();
                }
                if (viewDetailsModal && viewDetailsModal.classList.contains('modal-visible')) {
                    closeViewDetailsModal();
                }
            }
        });

        // Auto-hide flash messages
        const flashMessage = document.querySelector('.bg-green-50, .bg-red-50');
        if (flashMessage && flashMessage.closest('.mb-6')) {
            setTimeout(() => {
                flashMessage.style.opacity = '0';
                flashMessage.style.transition = 'opacity 0.5s ease-out';
                setTimeout(() => {
                    if (flashMessage.parentNode) {
                        flashMessage.parentNode.removeChild(flashMessage);
                    }
                }, 500);
            }, 5000);
        }
    });
</script>

@endsection
