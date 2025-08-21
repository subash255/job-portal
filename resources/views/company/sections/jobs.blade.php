<!-- Jobs Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manage Jobs</h1>
            <p class="text-gray-600 mt-1">Create, edit, and manage your job postings</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('company.create') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="ri-add-line mr-2"></i>Post New Job
            </a>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
        <div class="flex">
            <div class="py-1">
                <i class="ri-check-circle-line mr-2"></i>
            </div>
            <div>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
        <div class="flex">
            <div class="py-1">
                <i class="ri-error-warning-line mr-2"></i>
            </div>
            <div>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    </div>
@endif




<!-- Jobs List -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100">
    
    <div class="divide-y divide-gray-100">
        @foreach ($works as $work)
        <!-- Job Item -->
        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h4 class="text-lg font-semibold text-gray-800">{{$work->title}}</h4>
                        @if($work->status == 'active')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                <i class="ri-pulse-line mr-1"></i> Active
                            </span>
                        @elseif($work->status == 'closed')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                <i class="ri-close-circle-line mr-1"></i> Closed
                            </span>
                        @elseif($work->status == 'draft')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                <i class="ri-time-line mr-1"></i> Draft
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                        <span><i class="ri-map-pin-line mr-1"></i> {{$work->location}}</span>
                        <span><i class="ri-money-dollar-circle-line mr-1"></i> {{$work->salary}}</span>
                        <span><i class="ri-calendar-line mr-1"></i> {{$work->created_at->diffForHumans()}}</span>
                    </div>
                    <p class="text-gray-600 text-sm line-clamp-2">{{$work->description}}</p>
                </div>
                <div class="text-right ml-6">
                    <div class="mb-2">
                        <span class="text-2xl font-bold text-indigo-600">{{ $work->applicants()->count() }}</span>
                        <p class="text-sm text-gray-500">Applications</p>
                    </div>
                    <div class="flex gap-2">
                       
                        <a href="{{ route('company.jobs.edit', $work->id) }}" class="p-2 text-gray-400 hover:text-blue-600 transition-colors rounded-lg hover:bg-blue-50" title="Edit Job">
                            <i class="ri-edit-line"></i>
                        </a>
                        <button type="button" 
                                onclick="confirmDeleteJob({{ $work->id }}, '{{ $work->title }}')"
                                class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" 
                                title="Delete Job">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        
    </div>
</div>

<!-- Pagination -->
<div class="mt-8 flex items-center justify-between">
    <div class="text-sm text-gray-700">
        Showing <span class="font-medium">{{ $works->count() > 0 ? 1 : 0 }}</span> to <span class="font-medium">{{ $works->count() }}</span> of <span class="font-medium">{{ $works->count() }}</span> jobs
    </div>
    @if($works->count() == 0)
        <div class="text-center py-8">
            <div class="text-gray-400 mb-4">
                <i class="ri-briefcase-line text-6xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No jobs posted yet</h3>
            <p class="text-gray-500 mb-4">Start by creating your first job posting to attract candidates.</p>
            <a href="{{ route('company.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                <i class="ri-add-line mr-2"></i>Post Your First Job
            </a>
        </div>
    @endif
</div>

<!-- Modal CSS -->
<style>
    .modal-hidden {
        display: none;
    }
    
    .modal-visible {
        display: flex;
        animation: fadeIn 0.2s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .modal-visible .modal-content {
        animation: slideIn 0.3s ease-out;
    }
    
    @keyframes slideIn {
        from { 
            transform: translateY(-50px);
            opacity: 0;
        }
        to { 
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<!-- Delete Job Confirmation Modal -->
<div id="deleteJobModal" class="fixed inset-0 bg-black bg-opacity-50 modal-hidden items-center justify-center z-50">
    <div class="modal-content bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="ri-delete-bin-line text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Delete Job</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone</p>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="mb-6">
                <p class="text-gray-700 mb-4">
                    Are you sure you want to delete the job posting "<span id="jobTitle" class="font-semibold"></span>"?
                </p>
                
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="ri-briefcase-line text-red-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Job Posting</h4>
                            <p class="text-sm text-gray-600">This will permanently remove the job and all applications</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start space-x-2">
                        <i class="ri-warning-line text-yellow-600 mt-0.5"></i>
                        <div class="text-sm text-yellow-800">
                            <p class="font-medium">Warning:</p>
                            <ul class="mt-1 space-y-1 text-xs">
                                <li>• The job posting will be permanently deleted</li>
                                <li>• All applications for this job will be removed</li>
                                <li>• Applicants will no longer be able to view this job</li>
                                <li>• This action cannot be reversed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="flex space-x-3 justify-end">
                <button type="button" 
                        onclick="closeDeleteJobModal()"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    <i class="ri-close-line mr-1"></i>
                    Cancel
                </button>
                <form id="deleteJobForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                        <i class="ri-delete-bin-line mr-1"></i>
                        Delete Job
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let currentJobId = null;
    const deleteJobBaseUrl = '{{ route("company.jobs.delete", ":id") }}';

    // Job delete modal functions
    function confirmDeleteJob(jobId, jobTitle) {
        try {
            currentJobId = jobId;
            const modal = document.getElementById('deleteJobModal');
            const jobTitleSpan = document.getElementById('jobTitle');
            const deleteForm = document.getElementById('deleteJobForm');
            
            if (modal && jobTitleSpan && deleteForm) {
                // Set job title in modal
                jobTitleSpan.textContent = jobTitle;
                
                // Set form action with proper route construction
                deleteForm.action = deleteJobBaseUrl.replace(':id', jobId);
                
                // Show modal
                modal.classList.remove('modal-hidden');
                modal.classList.add('modal-visible');
                document.body.style.overflow = 'hidden';
            }
        } catch (error) {
            console.error('Error opening delete job modal:', error);
            // Fallback to browser confirm
            if (confirm(`Are you sure you want to delete the job "${jobTitle}"? This action cannot be undone.`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteJobBaseUrl.replace(':id', jobId);
                
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

    function closeDeleteJobModal() {
        try {
            const modal = document.getElementById('deleteJobModal');
            if (modal) {
                modal.classList.add('modal-hidden');
                modal.classList.remove('modal-visible');
                document.body.style.overflow = '';
                currentJobId = null;
            }
        } catch (error) {
            console.error('Error closing delete job modal:', error);
        }
    }

    // Event listeners for modal
    document.addEventListener('DOMContentLoaded', function() {
        // Close modal when clicking outside
        const deleteJobModal = document.getElementById('deleteJobModal');
        if (deleteJobModal) {
            deleteJobModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDeleteJobModal();
                }
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('deleteJobModal');
                if (modal && modal.classList.contains('modal-visible')) {
                    closeDeleteJobModal();
                }
            }
        });
    });
</script>
