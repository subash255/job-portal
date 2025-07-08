<!-- Applications Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Applications</h1>
            <p class="text-gray-600 mt-1">Review and manage candidate applications</p>
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
            <h3 class="text-xl font-bold text-gray-800">Applications</h3>
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
                        @elseif($application->status == 'under_review') bg-yellow-100 text-yellow-700
                        @elseif($application->status == 'shortlisted') bg-green-100 text-green-700
                        @elseif($application->status == 'interview') bg-purple-100 text-purple-700
                        @elseif($application->status == 'rejected') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ ucfirst($application->status ?? 'Applied') }}
                    </span>
                    <div class="flex gap-2">
                        @if($application->user->resume)
                            <a href="{{ asset('storage/' . $application->user->resume) }}" target="_blank" class="p-2 text-gray-400 hover:text-indigo-600 transition-colors rounded-lg hover:bg-indigo-50" title="View Resume">
                                <i class="ri-file-text-line"></i>
                            </a>
                        @endif
                        <form method="POST" action="{{ route('company.application.update-status', $application->id) }}" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="shortlisted">
                            <button type="submit" class="p-2 text-gray-400 hover:text-green-600 transition-colors rounded-lg hover:bg-green-50" title="Shortlist">
                                <i class="ri-bookmark-line"></i>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('company.application.update-status', $application->id) }}" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="interview">
                            <button type="submit" class="p-2 text-gray-400 hover:text-purple-600 transition-colors rounded-lg hover:bg-purple-50" title="Schedule Interview">
                                <i class="ri-calendar-line"></i>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('company.application.update-status', $application->id) }}" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" title="Reject" onclick="return confirm('Are you sure you want to reject this application?')">
                                <i class="ri-close-line"></i>
                            </button>
                        </form>
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

<!-- Pagination -->
@if($applications->hasPages())
<div class="mt-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $applications->total() }} applications
            </div>
            <div class="flex items-center space-x-2">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
</div>
@endif
