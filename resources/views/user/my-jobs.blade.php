@extends('user.layout')

@section('user-content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Applications</h1>
                <p class="text-gray-600 mt-1">Track your job applications and their status</p>
            </div>
            <div class="bg-blue-50 px-4 py-2 rounded-lg">
                <span class="text-sm text-blue-600 font-medium">{{ $appliedJobs->total() }} Applications</span>
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

    <!-- Search & Filter -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-4">
            <form method="GET" action="{{ route('user.my-jobs') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search by job title or company..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex gap-3">
                    <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="applied" {{ request('status') == 'applied' ? 'selected' : '' }}>Applied</option>
                        <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
                        <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="ri-filter-line"></i>
                    </button>
                    @if(request('search') || request('status'))
                    <a href="{{ route('user.my-jobs') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Clear
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Applications List -->
    <div class="space-y-4">
        @forelse($appliedJobs as $job)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <!-- Job Details -->
                    <div class="flex items-start space-x-4 flex-1">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            @if($job->work->user->profile_picture)
                                <img src="{{ asset('storage/' . $job->work->user->profile_picture) }}" alt="Company Logo" class="w-10 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="ri-building-line text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $job->work->title }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $job->work->user->name }}</p>
                                    <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                        <span class="flex items-center space-x-1">
                                            <i class="ri-map-pin-line"></i>
                                            <span>{{ $job->work->location }}</span>
                                        </span>
                                        <span class="flex items-center space-x-1">
                                            <i class="ri-time-line"></i>
                                            <span>{{ $job->work->type }}</span>
                                        </span>
                                        <span class="flex items-center space-x-1">
                                            <i class="ri-money-dollar-circle-line"></i>
                                            <span>{{ $job->work->salary ?: 'Negotiable' }}</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end space-y-2">
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
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                        <i class="{{ $statusIcon }} mr-1"></i>
                                        {{ ucfirst(str_replace('_', ' ', $currentStatus)) }}
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Application Status & Actions -->
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-6">
                            <div class="text-sm text-gray-600">
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
                            <div class="text-sm text-gray-600">
                                <span class="font-medium">Applied:</span>
                                <span class="ml-1">{{ ($job->applied_at ?? $job->created_at)->format('M d, Y') }}</span>
                            </div>
                            @if($job->work->end_date)
                            <div class="text-sm text-gray-600">
                                <span class="font-medium">Deadline:</span>
                                <span class="ml-1">{{ $job->work->end_date->format('M d, Y') }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex items-center">
                            <form method="POST" action="{{ route('user.withdraw-application', $job->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 text-sm font-medium transition-colors" 
                                        onclick="return confirm('Are you sure you want to withdraw this application? This action cannot be undone.')">
                                    <i class="ri-close-circle-line mr-1"></i>
                                    Withdraw
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ri-briefcase-line text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Applications Yet</h3>
            <p class="text-gray-600 mb-6">You haven't applied to any jobs yet. Start your job search now!</p>
            <a href="{{ route('welcome') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="ri-search-line mr-2"></i>
                Browse Jobs
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($appliedJobs->hasPages())
    <div class="mt-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            {{ $appliedJobs->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
