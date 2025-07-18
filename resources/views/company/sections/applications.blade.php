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
                        @if($application->status !== 'interview')
                        <form method="POST" action="{{ route('company.application.update-status', $application->id) }}" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="interview">
                            <button type="submit" class="p-2 text-gray-400 hover:text-purple-600 transition-colors rounded-lg hover:bg-purple-50" title="Schedule Interview">
                                <i class="ri-calendar-line"></i>
                            </button>
                        </form>
                        @endif
                        @if($application->status !== 'rejected')
                        <form method="POST" action="{{ route('company.application.update-status', $application->id) }}" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" title="Reject" onclick="return confirm('Are you sure you want to reject this application?')">
                                <i class="ri-close-line"></i>
                            </button>
                        </form>
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
</script>

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
