<!-- Applications Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Applications</h1>
            <p class="text-gray-600 mt-1">Review and manage candidate applications</p>
        </div>
        <!-- Search and Filter Section -->
        <div class="flex items-center space-x-4">
            <form method="GET" action="{{ route('company.applications') }}" class="flex items-center space-x-3">
                <div class="relative">
                    <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                        <option value="">All Status</option>
                        <option value="applied" {{ request('status') == 'applied' ? 'selected' : '' }}>Applied</option>
                        <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                    <i class="ri-search-line mr-2"></i>Search
                </button>
                @if(request('status'))
                    <a href="{{ route('company.applications') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="ri-close-line mr-2"></i>Clear
                    </a>
                @endif
            </form>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <i class="ri-check-circle-line mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <i class="ri-error-warning-line mr-2"></i>
            {{ session('error') }}
        </div>
    </div>
@endif

<!-- Applications List -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <h3 class="text-xl font-bold text-gray-800">Applications</h3>
                @if(request('status'))
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <i class="ri-filter-line mr-1"></i>
                        {{ ucfirst(str_replace('_', ' ', request('status'))) }}
                    </span>
                @endif
            </div>
            <span class="text-sm text-gray-500">{{ $applications->total() }} total applications</span>
        </div>
    </div>
    
    @if($applications->count() > 0)
    <div class="divide-y divide-gray-100">
        @foreach ($applications as $application)
        <!-- Application Item -->
        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr($application->user->name ?? 'U', 0, 1)) }}{{ strtoupper(substr(explode(' ', $application->user->name ?? 'User')[1] ?? '', 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $application->user->name ?? 'Unknown User' }}</h4>
                        <p class="text-sm text-gray-600">Applied for {{ $application->work->title }}</p>
                        <div class="flex items-center gap-4 mt-1">
                            <span class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</span>
                            <span class="text-xs text-gray-500">•</span>
                            <span class="text-xs text-gray-500">{{ $application->user->email ?? 'No email' }}</span>
                            @if($application->phone)
                                <span class="text-xs text-gray-500">•</span>
                                <span class="text-xs text-gray-500">{{ $application->phone }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                        @if($application->status == 'applied') bg-blue-100 text-blue-700
                        @elseif($application->status == 'interview') bg-purple-100 text-purple-700
                        @elseif($application->status == 'rejected') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ ucfirst($application->status ?? 'Applied') }}
                    </span>
                    <div class="flex gap-2">
                        <button type="button" class="p-2 text-gray-400 hover:text-indigo-600 transition-colors rounded-lg hover:bg-indigo-50" title="View Applicant Details" onclick="openApplicantModal({{ $application->id }})">
                            <i class="ri-eye-line"></i>
                        </button>
                        @if($application->status === 'applied')
                        <button type="button" 
                                onclick="confirmScheduleInterview({{ $application->id }}, '{{ $application->user->name ?? 'Unknown User' }}', '{{ $application->work->title }}')"
                                class="p-2 text-gray-400 hover:text-purple-600 transition-colors rounded-lg hover:bg-purple-50" 
                                title="Schedule Interview">
                            <i class="ri-calendar-line"></i>
                        </button>
                        @endif
                        @if($application->status !== 'rejected')
                        <button type="button" 
                                onclick="confirmRejectApplication({{ $application->id }}, '{{ $application->user->name ?? 'Unknown User' }}', '{{ $application->work->title }}')"
                                class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" 
                                title="Reject Application">
                            <i class="ri-close-line"></i>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="p-12 text-center">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="ri-inbox-line text-4xl text-gray-400"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Applications Found</h3>
        <p class="text-gray-600">You haven't received any applications yet.</p>
    </div>
    @endif
</div>

<!-- Applicant Details Modal -->
<div id="applicantModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[80vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Applicant Details</h2>
                    <button onclick="closeApplicantModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>
                
                <div id="applicantDetails" class="space-y-4">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openApplicantModal(applicationId) {
    fetch(`/company/application/${applicationId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('applicantDetails').innerHTML = data.html;
            document.getElementById('applicantModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading applicant details');
        });
}

function closeApplicantModal() {
    document.getElementById('applicantModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('applicantModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeApplicantModal();
    }
});

// Reject application modal functions
let currentApplicationId = null;
let currentInterviewApplicationId = null;
const rejectApplicationBaseUrl = '{{ route("company.application.update-status", ":id") }}';
const scheduleInterviewBaseUrl = '{{ route("company.application.update-status", ":id") }}';

function confirmScheduleInterview(applicationId, applicantName, jobTitle) {
    try {
        currentInterviewApplicationId = applicationId;
        const modal = document.getElementById('scheduleInterviewModal');
        const applicantNameSpan = document.getElementById('interviewApplicantName');
        const jobTitleSpan = document.getElementById('interviewJobTitle');
        const scheduleForm = document.getElementById('scheduleInterviewForm');
        
        if (modal && applicantNameSpan && jobTitleSpan && scheduleForm) {
            // Set applicant details in modal
            applicantNameSpan.textContent = applicantName;
            jobTitleSpan.textContent = jobTitle;
            
            // Set form action with proper route construction
            scheduleForm.action = scheduleInterviewBaseUrl.replace(':id', applicationId);
            
            // Set minimum date to today
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const minDate = tomorrow.toISOString().split('T')[0];
            document.getElementById('interviewDate').min = minDate;
            
            // Show modal
            modal.classList.remove('modal-hidden');
            modal.classList.add('modal-visible');
            document.body.style.overflow = 'hidden';
        }
    } catch (error) {
        console.error('Error opening schedule interview modal:', error);
        // Fallback to simple form submission
        if (confirm(`Schedule interview for ${applicantName}?`)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = scheduleInterviewBaseUrl.replace(':id', applicationId);
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const statusField = document.createElement('input');
            statusField.type = 'hidden';
            statusField.name = 'status';
            statusField.value = 'interview';
            
            form.appendChild(csrfToken);
            form.appendChild(statusField);
            document.body.appendChild(form);
            form.submit();
        }
    }
}

function closeScheduleInterviewModal() {
    try {
        const modal = document.getElementById('scheduleInterviewModal');
        if (modal) {
            modal.classList.add('modal-hidden');
            modal.classList.remove('modal-visible');
            document.body.style.overflow = '';
            currentInterviewApplicationId = null;
            
            // Reset form
            document.getElementById('scheduleInterviewForm').reset();
        }
    } catch (error) {
        console.error('Error closing schedule interview modal:', error);
    }
}

function confirmRejectApplication(applicationId, applicantName, jobTitle) {
    try {
        currentApplicationId = applicationId;
        const modal = document.getElementById('rejectApplicationModal');
        const applicantNameSpan = document.getElementById('applicantName');
        const jobTitleSpan = document.getElementById('jobTitle');
        const rejectForm = document.getElementById('rejectApplicationForm');
        
        if (modal && applicantNameSpan && jobTitleSpan && rejectForm) {
            // Set applicant details in modal
            applicantNameSpan.textContent = applicantName;
            jobTitleSpan.textContent = jobTitle;
            
            // Set form action with proper route construction
            rejectForm.action = rejectApplicationBaseUrl.replace(':id', applicationId);
            
            // Show modal
            modal.classList.remove('modal-hidden');
            modal.classList.add('modal-visible');
            document.body.style.overflow = 'hidden';
        }
    } catch (error) {
        console.error('Error opening reject application modal:', error);
        // Fallback to browser confirm
        if (confirm(`Are you sure you want to reject ${applicantName}'s application for ${jobTitle}? This action cannot be undone.`)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = rejectApplicationBaseUrl.replace(':id', applicationId);
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const statusField = document.createElement('input');
            statusField.type = 'hidden';
            statusField.name = 'status';
            statusField.value = 'rejected';
            
            form.appendChild(csrfToken);
            form.appendChild(statusField);
            document.body.appendChild(form);
            form.submit();
        }
    }
}

function closeRejectApplicationModal() {
    try {
        const modal = document.getElementById('rejectApplicationModal');
        if (modal) {
            modal.classList.add('modal-hidden');
            modal.classList.remove('modal-visible');
            document.body.style.overflow = '';
            currentApplicationId = null;
        }
    } catch (error) {
        console.error('Error closing reject application modal:', error);
    }
}

// Event listeners for reject modal
document.addEventListener('DOMContentLoaded', function() {
    // Close reject modal when clicking outside
    const rejectApplicationModal = document.getElementById('rejectApplicationModal');
    if (rejectApplicationModal) {
        rejectApplicationModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectApplicationModal();
            }
        });
    }

    // Close schedule interview modal when clicking outside
    const scheduleInterviewModal = document.getElementById('scheduleInterviewModal');
    if (scheduleInterviewModal) {
        scheduleInterviewModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeScheduleInterviewModal();
            }
        });
    }

    // Close modals with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const rejectModal = document.getElementById('rejectApplicationModal');
            const interviewModal = document.getElementById('scheduleInterviewModal');
            
            if (rejectModal && rejectModal.classList.contains('modal-visible')) {
                closeRejectApplicationModal();
            }
            if (interviewModal && interviewModal.classList.contains('modal-visible')) {
                closeScheduleInterviewModal();
            }
        }
    });
});
</script>

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

<!-- Schedule Interview Modal -->
<div id="scheduleInterviewModal" class="fixed inset-0 bg-black bg-opacity-50 modal-hidden items-center justify-center z-50 p-4">
    <div class="modal-content bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                    <i class="ri-calendar-check-line text-purple-600 text-xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">Schedule Interview</h3>
                    <p class="text-sm text-gray-500">Set interview date and time for the applicant</p>
                </div>
                <button type="button" onclick="closeScheduleInterviewModal()" class="text-gray-400 hover:text-gray-600 ml-4">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <!-- Applicant Info -->
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="ri-user-line text-purple-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Interview with <span id="interviewApplicantName" class="text-purple-600"></span></h4>
                        <p class="text-sm text-gray-600">For the position: "<span id="interviewJobTitle" class="font-medium"></span>"</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <form id="scheduleInterviewForm" method="POST">
                @csrf
                <input type="hidden" name="status" value="interview">
                
                <!-- Row 1: Date and Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="interviewDate" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="ri-calendar-line mr-1"></i>Interview Date
                        </label>
                        <input type="date" 
                               id="interviewDate" 
                               name="interview_date" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>
                    
                    <div>
                        <label for="interviewTime" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="ri-time-line mr-1"></i>Interview Time
                        </label>
                        <select id="interviewTime" 
                                name="interview_time" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Select Time</option>
                            <option value="09:00">09:00 AM</option>
                            <option value="09:30">09:30 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="10:30">10:30 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="11:30">11:30 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="13:00">01:00 PM</option>
                            <option value="13:30">01:30 PM</option>
                            <option value="14:00">02:00 PM</option>
                            <option value="14:30">02:30 PM</option>
                            <option value="15:00">03:00 PM</option>
                            <option value="15:30">03:30 PM</option>
                            <option value="16:00">04:00 PM</option>
                            <option value="16:30">04:30 PM</option>
                            <option value="17:00">05:00 PM</option>
                        </select>
                    </div>
                </div>

                <!-- Row 2: Interview Type -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        <i class="ri-video-line mr-1"></i>Interview Type
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="interview_type" value="in-person" class="mr-3 text-purple-600" required>
                            <div class="flex items-center">
                                <i class="ri-building-line text-gray-500 mr-2"></i>
                                <div>
                                    <div class="font-medium text-gray-900">In-Person</div>
                                    <div class="text-xs text-gray-500">Office interview</div>
                                </div>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="interview_type" value="online" class="mr-3 text-purple-600" required>
                            <div class="flex items-center">
                                <i class="ri-video-line text-gray-500 mr-2"></i>
                                <div>
                                    <div class="font-medium text-gray-900">Online</div>
                                    <div class="text-xs text-gray-500">Video call</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Row 3: Additional Notes -->
                <div class="mb-6">
                    <label for="interviewNotes" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="ri-message-line mr-1"></i>Additional Notes (Optional)
                    </label>
                    <textarea id="interviewNotes" 
                              name="interview_notes" 
                              rows="3"
                              placeholder="Meeting link, office address, preparation instructions..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"></textarea>
                </div>

                <!-- Info Section -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start space-x-2">
                        <i class="ri-information-line text-blue-600 mt-0.5"></i>
                        <div class="text-sm text-blue-800">
                            <p class="font-medium">What happens next:</p>
                            <div class="mt-1 text-xs space-y-1">
                                <p>• Application status updated to "Interview" • Applicant receives email notification</p>
                                <p>• Interview details saved in system • Schedule can be modified later</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                    <button type="button" 
                            onclick="closeScheduleInterviewModal()"
                            class="w-full sm:w-auto px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                        <i class="ri-close-line mr-1"></i>
                        Cancel
                    </button>
                    <button type="submit" 
                            class="w-full sm:w-auto px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium">
                        <i class="ri-calendar-check-line mr-1"></i>
                        Schedule Interview
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Application Confirmation Modal -->
<div id="rejectApplicationModal" class="fixed inset-0 bg-black bg-opacity-50 modal-hidden items-center justify-center z-50">
    <div class="modal-content bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="ri-close-circle-line text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Reject Application</h3>
                    <p class="text-sm text-gray-500">This action will notify the applicant</p>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="mb-6">
                <p class="text-gray-700 mb-4">
                    Are you sure you want to reject <span id="applicantName" class="font-semibold"></span>'s application for "<span id="jobTitle" class="font-semibold"></span>"?
                </p>
                
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="ri-user-line text-red-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Job Application</h4>
                            <p class="text-sm text-gray-600">The applicant will be notified of the rejection</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start space-x-2">
                        <i class="ri-information-line text-yellow-600 mt-0.5"></i>
                        <div class="text-sm text-yellow-800">
                            <p class="font-medium">What happens when you reject:</p>
                            <ul class="mt-1 space-y-1 text-xs">
                                <li>• The application status will be changed to "Rejected"</li>
                                <li>• The applicant may receive a notification email</li>
                                <li>• The application will remain in your records</li>
                                <li>• You can still view the application details later</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="flex space-x-3 justify-end">
                <button type="button" 
                        onclick="closeRejectApplicationModal()"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    <i class="ri-arrow-left-line mr-1"></i>
                    Cancel
                </button>
                <form id="rejectApplicationForm" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                        <i class="ri-close-circle-line mr-1"></i>
                        Reject Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
@if($applications->hasPages())
<div class="mt-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $applications->total() }} applications
            </div>
            <div class="flex items-center space-x-2">
                {{ $applications->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endif
