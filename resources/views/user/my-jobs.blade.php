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
                        <div class="flex items-center justify-start sm:justify-end">
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
        // Close modal when clicking outside
        const withdrawModal = document.getElementById('withdrawModal');
        if (withdrawModal) {
            withdrawModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeWithdrawModal();
                }
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('withdrawModal');
                if (modal && modal.classList.contains('modal-visible')) {
                    closeWithdrawModal();
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
