<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-4">
        <div class="h-12 w-12 bg-indigo-100 rounded-full flex items-center justify-center">
            <span class="text-indigo-600 font-semibold text-lg">
                {{ strtoupper(substr($application->user->name, 0, 1)) }}
            </span>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-gray-900">{{ $application->user->name }}</h3>
            <p class="text-gray-500">{{ $application->user->email }}</p>
        </div>
    </div>

    <!-- Application Info -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-2">Application Details</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <span class="text-sm text-gray-600">Applied for:</span>
                <p class="font-medium">{{ $application->work->title }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-600">Position:</span>
                <p class="font-medium">{{ $application->work->position }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-600">Applied on:</span>
                <p class="font-medium">{{ $application->created_at->format('M d, Y') }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-600">Status:</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if($application->status === 'applied') bg-blue-100 text-blue-800
                    @elseif($application->status === 'interview') bg-purple-100 text-purple-800
                    @elseif($application->status === 'rejected') bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Personal Information -->
    <div>
        <h4 class="font-semibold text-gray-900 mb-3">Personal Information</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if($application->user->phone)
            <div>
                <span class="text-sm text-gray-600">Phone:</span>
                <p class="font-medium">{{ $application->user->phone }}</p>
            </div>
            @endif
            @if($application->user->address)
            <div>
                <span class="text-sm text-gray-600">Address:</span>
                <p class="font-medium">{{ $application->user->address }}</p>
            </div>
            @endif
            @if($application->user->date_of_birth)
            <div>
                <span class="text-sm text-gray-600">Date of Birth:</span>
                <p class="font-medium">{{ \Carbon\Carbon::parse($application->user->date_of_birth)->format('M d, Y') }}</p>
            </div>
            @endif
            @if($application->user->gender)
            <div>
                <span class="text-sm text-gray-600">Gender:</span>
                <p class="font-medium">{{ ucfirst($application->user->gender) }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Professional Information -->
    <div>
        <h4 class="font-semibold text-gray-900 mb-3">Professional Information</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if($application->user->experience_years)
            <div>
                <span class="text-sm text-gray-600">Experience:</span>
                <p class="font-medium">{{ $application->user->experience_years }} years</p>
            </div>
            @endif
            @if($application->user->education)
            <div>
                <span class="text-sm text-gray-600">Education:</span>
                <p class="font-medium">{{ $application->user->education }}</p>
            </div>
            @endif
            @if($application->user->skills)
            <div class="md:col-span-2">
                <span class="text-sm text-gray-600">Skills:</span>
                <p class="font-medium">{{ $application->user->skills }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Additional Application Fields -->
    @if($application->cover_letter || $application->portfolio_url || $application->expected_salary || $application->availability_date)
    <div>
        <h4 class="font-semibold text-gray-900 mb-3">Additional Information</h4>
        <div class="space-y-3">
            @if($application->cover_letter)
            <div>
                <span class="text-sm text-gray-600">Cover Letter:</span>
                <div class="mt-1 p-3 bg-gray-50 rounded-md">
                    <p class="text-sm text-gray-800">{{ $application->cover_letter }}</p>
                </div>
            </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($application->portfolio_url)
                <div>
                    <span class="text-sm text-gray-600">Portfolio:</span>
                    <a href="{{ $application->portfolio_url }}" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-500">
                        View Portfolio
                    </a>
                </div>
                @endif
                @if($application->expected_salary)
                <div>
                    <span class="text-sm text-gray-600">Expected Salary:</span>
                    <p class="font-medium">{{ $application->expected_salary }}</p>
                </div>
                @endif
                @if($application->availability_date)
                <div>
                    <span class="text-sm text-gray-600">Available From:</span>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($application->availability_date)->format('M d, Y') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Resume -->
    @if($application->user->resume)
    <div>
        <h4 class="font-semibold text-gray-900 mb-3">Resume</h4>
        <div class="flex items-center space-x-3">
            <div class="flex items-center space-x-2">
                <i class="ri-file-text-line text-gray-400"></i>
                <span class="text-sm text-gray-600">Resume.pdf</span>
            </div>
            <a href="{{ asset('storage/' . $application->user->resume) }}" target="_blank" 
               class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="ri-eye-line mr-1"></i>
                View Resume
            </a>
        </div>
    </div>
    @else
      <div>
        <h4 class="font-semibold text-gray-900 mb-3">Resume</h4>
        <div class="flex items-center space-x-3">
            <div class="flex items-center space-x-2">
                <i class="ri-file-text-line text-gray-400"></i>
                <span class="text-sm text-gray-600">Resume.pdf</span>
            </div>
            <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" 
               class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="ri-eye-line mr-1"></i>
                View Resume
            </a>
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3 pt-4 border-t">
        @if($application->status !== 'interview')
        <form method="POST" action="{{ route('company.application.update-status', $application->id) }}" class="inline">
            @csrf
            <input type="hidden" name="status" value="interview">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                <i class="ri-calendar-line mr-2"></i>
                Schedule Interview
            </button>
        </form>
        @endif
        
        @if($application->status !== 'rejected')
        <form method="POST" action="{{ route('company.application.update-status', $application->id) }}" class="inline">
            @csrf
            <input type="hidden" name="status" value="rejected">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    onclick="return confirm('Are you sure you want to reject this application?')">
                <i class="ri-close-line mr-2"></i>
                Reject
            </button>
        </form>
        @endif
    </div>
</div>
