@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('welcome') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium">
                <i class="ri-arrow-left-line mr-2"></i>Back to Jobs
            </a>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-8">
                    <!-- Company Name -->
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $work->user->name }}</h1>
                    </div>

                    <!-- Job Name -->
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-900">{{ $work->title }}</h2>
                    </div>

                    <!-- Job Info -->
                    <div class="mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3">
                                <i class="ri-apps-2-line text-blue-600"></i>
                                <div>
                                    <span class="text-sm text-gray-500">Category</span>
                                    <p class="font-medium">{{ $work->category->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="ri-briefcase-line text-green-600"></i>
                                <div>
                                    <span class="text-sm text-gray-500">Position</span>
                                    <p class="font-medium">{{ $work->position }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="ri-map-pin-line text-purple-600"></i>
                                <div>
                                    <span class="text-sm text-gray-500">Location</span>
                                    <p class="font-medium">{{ $work->location }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="ri-money-dollar-circle-line text-orange-600"></i>
                                <div>
                                    <span class="text-sm text-gray-500">Salary</span>
                                    <p class="font-medium">{{ $work->salary ?: 'Negotiable' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="ri-time-line text-indigo-600"></i>
                                <div>
                                    <span class="text-sm text-gray-500">Type</span>
                                    <p class="font-medium">{{ $work->type }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="ri-calendar-line text-red-600"></i>
                                <div>
                                    <span class="text-sm text-gray-500">Deadline</span>
                                    <p class="font-medium">{{ $work->end_date ? $work->end_date->format('M d, Y') : 'Open' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Apply Button -->
                    <div class="mb-8">
                        @php
                            $isExpired = $work->end_date && \Carbon\Carbon::parse($work->end_date)->isPast();
                            $isJobClosed = in_array($work->status, ['closed', 'draft']);
                            $canApply = !$isExpired && !$isJobClosed;
                        @endphp

                        @if($isExpired)
                            <!-- Job Expired -->
                            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="ri-time-line text-orange-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-orange-800">Application Deadline Passed</h4>
                                        <p class="text-orange-700 text-sm mt-1">
                                            This job expired on {{ \Carbon\Carbon::parse($work->end_date)->format('F d, Y') }}
                                            ({{ \Carbon\Carbon::parse($work->end_date)->diffForHumans() }}).
                                        </p>
                                        <div class="mt-3">
                                            <a href="{{ route('job') }}" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-medium text-sm">
                                                <i class="ri-search-line mr-1"></i>Browse Other Jobs
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($isJobClosed)
                            <!-- Job Closed -->
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="ri-close-circle-line text-red-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-red-800">Job Application Closed</h4>
                                        <p class="text-red-700 text-sm mt-1">
                                            This job is currently {{ $work->status }} and not accepting applications.
                                        </p>
                                        <div class="mt-3">
                                            <a href="{{ route('job') }}" class="inline-flex items-center text-red-600 hover:text-red-700 font-medium text-sm">
                                                <i class="ri-search-line mr-1"></i>Browse Other Jobs
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @auth
                                @if(auth()->user()->role == 'user')
                                    @php
                                        $hasApplied = \App\Models\Applicant::where('work_id', $work->id)
                                            ->where('applicant_id', auth()->id())
                                            ->exists();
                                    @endphp
                                    
                                    @if($hasApplied)
                                        <div class="inline-flex items-center bg-green-100 text-green-800 px-6 py-3 rounded-lg font-semibold">
                                            <i class="ri-check-circle-line mr-2"></i>
                                            Already Applied
                                        </div>
                                        <p class="text-sm text-gray-600 mt-2">You have already applied to this position. Check your applications for status updates.</p>
                                    @else
                                        <a href="{{ route('work.apply.form', $work->id) }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                            <i class="ri-send-plane-line mr-2"></i>Apply Now
                                        </a>
                                    @endif
                                @else
                                    <p class="text-gray-500 italic">Only job seekers can apply for positions.</p>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    <i class="ri-login-circle-line mr-2"></i>Login to Apply
                                </a>
                            @endauth
                        @endif
                    </div>

                    <!-- Job Details Sections -->
                    <div class="border-t pt-6 space-y-8">
                        
                        @php
                            // Check if we have structured data or just description
                            $hasStructuredData = $work->responsibility || $work->expected_requirement || $work->benefits;
                        @endphp

                        @if($hasStructuredData)
                            <!-- Structured Job Information -->
                            
                            <!-- Job Description -->
                            @if($work->description)
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <i class="ri-file-text-line text-blue-600 mr-2"></i>
                                    Job Description
                                </h3>
                                <div class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-lg">
                                    {!! nl2br(e($work->description)) !!}
                                </div>
                            </div>
                            @endif

                            <!-- Responsibilities -->
                            @if($work->responsibility)
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <i class="ri-task-line text-green-600 mr-2"></i>
                                    Responsibilities
                                </h3>
                                <div class="text-gray-700 leading-relaxed bg-green-50 p-4 rounded-lg">
                                    @php
                                        $responsibilities = explode("\n", $work->responsibility);
                                        $hasBullets = false;
                                        
                                        foreach($responsibilities as $line) {
                                            $trimmed = trim($line);
                                            
                                            if($trimmed && (
                                                substr($trimmed, 0, 1) === '•' || 
                                                substr($trimmed, 0, 1) === '-' || 
                                                substr($trimmed, 0, 1) === '*' ||
                                                substr($trimmed, 0, 2) === '• ' ||
                                                substr($trimmed, 0, 2) === '- ' ||
                                                substr($trimmed, 0, 2) === '* ' ||
                                                preg_match('/^[\s]*[•\-\*]\s*/', $trimmed)
                                            )) {
                                                $hasBullets = true;
                                                break;
                                            }
                                        }
                                        
                                        // Force bullet display for multi-line content
                                        if (!$hasBullets && count(array_filter($responsibilities, function($line) { return trim($line) != ''; })) > 1) {
                                            $hasBullets = true;
                                        }
                                    @endphp
                                    
                                    @if($hasBullets)
                                        <ul class="list-none space-y-2">
                                            @foreach($responsibilities as $responsibility)
                                                @php
                                                    $trimmed = trim($responsibility);
                                                    // Clean the text by removing bullet characters and extra spaces
                                                    $cleanText = preg_replace('/^[\s]*[•\-\*]\s*/', '', $trimmed);
                                                    $cleanText = trim($cleanText);
                                                @endphp
                                                @if($cleanText)
                                                    <li class="flex items-start">
                                                        <span class="text-green-600 mr-3 mt-1 flex-shrink-0">•</span>
                                                        <span class="flex-1">{{ $cleanText }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        {!! nl2br(e($work->responsibility)) !!}
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Requirements -->
                            @if($work->expected_requirement)
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <i class="ri-checkbox-multiple-line text-purple-600 mr-2"></i>
                                    Requirements
                                </h3>
                                <div class="text-gray-700 leading-relaxed bg-purple-50 p-4 rounded-lg">
                                    @php
                                        $requirements = explode("\n", $work->expected_requirement);
                                        $hasBullets = false;
                                        
                                        foreach($requirements as $line) {
                                            $trimmed = trim($line);
                                            if($trimmed && (
                                                substr($trimmed, 0, 1) === '•' || 
                                                substr($trimmed, 0, 1) === '-' || 
                                                substr($trimmed, 0, 1) === '*' ||
                                                substr($trimmed, 0, 2) === '• ' ||
                                                substr($trimmed, 0, 2) === '- ' ||
                                                substr($trimmed, 0, 2) === '* ' ||
                                                preg_match('/^[\s]*[•\-\*]\s*/', $trimmed)
                                            )) {
                                                $hasBullets = true;
                                                break;
                                            }
                                        }
                                        
                                        // Force bullet display for multi-line content
                                        if (!$hasBullets && count(array_filter($requirements, function($line) { return trim($line) != ''; })) > 1) {
                                            $hasBullets = true;
                                        }
                                    @endphp
                                    
                                    @if($hasBullets)
                                        <ul class="list-none space-y-2">
                                            @foreach($requirements as $requirement)
                                                @php
                                                    $trimmed = trim($requirement);
                                                    $cleanText = preg_replace('/^[\s]*[•\-\*]\s*/', '', $trimmed);
                                                    $cleanText = trim($cleanText);
                                                @endphp
                                                @if($cleanText)
                                                    <li class="flex items-start">
                                                        <span class="text-purple-600 mr-3 mt-1 flex-shrink-0">•</span>
                                                        <span class="flex-1">{{ $cleanText }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        {!! nl2br(e($work->expected_requirement)) !!}
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Benefits -->
                            @if($work->benefits)
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <i class="ri-gift-line text-orange-600 mr-2"></i>
                                    Benefits & Perks
                                </h3>
                                <div class="text-gray-700 leading-relaxed bg-orange-50 p-4 rounded-lg">
                                    @php
                                        $benefits = explode("\n", $work->benefits);
                                        $hasBullets = false;
                                        
                                        foreach($benefits as $line) {
                                            $trimmed = trim($line);
                                            if($trimmed && (
                                                substr($trimmed, 0, 1) === '•' || 
                                                substr($trimmed, 0, 1) === '-' || 
                                                substr($trimmed, 0, 1) === '*' ||
                                                substr($trimmed, 0, 2) === '• ' ||
                                                substr($trimmed, 0, 2) === '- ' ||
                                                substr($trimmed, 0, 2) === '* ' ||
                                                preg_match('/^[\s]*[•\-\*]\s*/', $trimmed)
                                            )) {
                                                $hasBullets = true;
                                                break;
                                            }
                                        }
                                        
                                        // Force bullet display for multi-line content
                                        if (!$hasBullets && count(array_filter($benefits, function($line) { return trim($line) != ''; })) > 1) {
                                            $hasBullets = true;
                                        }
                                    @endphp
                                    
                                    @if($hasBullets)
                                        <ul class="list-none space-y-2">
                                            @foreach($benefits as $benefit)
                                                @php
                                                    $trimmed = trim($benefit);
                                                    $cleanText = preg_replace('/^[\s]*[•\-\*]\s*/', '', $trimmed);
                                                    $cleanText = trim($cleanText);
                                                @endphp
                                                @if($cleanText)
                                                    <li class="flex items-start">
                                                        <span class="text-orange-600 mr-3 mt-1 flex-shrink-0">•</span>
                                                        <span class="flex-1">{{ $cleanText }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        {!! nl2br(e($work->benefits)) !!}
                                    @endif
                                </div>
                            </div>
                            @endif

                        @else
                            <!-- Fallback for jobs with only description -->
                            @if($work->description)
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <i class="ri-file-text-line text-blue-600 mr-2"></i>
                                    Job Information
                                </h3>
                                <div class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-lg">
                                    {!! nl2br(e($work->description)) !!}
                                </div>
                                
                                <!-- Encourage updating the job post -->
                                @auth
                                    @if(auth()->user()->id === $work->user_id)
                                    <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                                        <div class="flex items-start space-x-3">
                                            <i class="ri-information-line text-blue-600 mt-0.5"></i>
                                            <div>
                                                <h4 class="font-medium text-blue-800">Improve Your Job Posting</h4>
                                                <p class="text-blue-700 text-sm mt-1">
                                                    Add separate sections for responsibilities, requirements, and benefits to make your job posting more attractive.
                                                </p>
                                                <a href="{{ route('company.jobs.edit', $work->id) }}" 
                                                   class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm mt-2">
                                                    <i class="ri-edit-line mr-1"></i>Edit Job Posting
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endauth
                            </div>
                            @endif
                        @endif

                      

                    </div>

                    
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- About Company -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">About Company</h3>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                            @if($work->user->profile_picture)
                                <img src="{{ asset('storage/' . $work->user->profile_picture) }}" alt="Company Logo" class="w-14 h-14 rounded-lg object-cover">
                            @else
                               <i class="ri-building-line text-4xl text-white bg-indigo-700 p-3 rounded-lg"></i>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $work->user->name }}</h4>
                            <p class="text-gray-600 text-sm">{{ $work->user->email }}</p>
                        </div>
                    </div>
                    
                    @if($work->user->description)
                        <p class="text-gray-700 text-sm leading-relaxed mb-4">{{ $work->user->description }}</p>
                    @endif

                    <div class="space-y-3">
                        @if($work->user->company_website)
                        <div class="flex items-center space-x-2">
                            <i class="ri-global-line text-blue-600"></i>
                            <a href="{{ $work->user->company_website }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Visit Website</a>
                        </div>
                        @endif
                        @if($work->user->city)
                        <div class="flex items-center space-x-2">
                            <i class="ri-building-line text-gray-600"></i>
                            <span class="text-gray-600 text-sm">{{ $work->user->city }}</span>
                        </div>
                        @endif
                        @if($work->user->company_size)
                        <div class="flex items-center space-x-2">
                            <i class="ri-team-line text-gray-600"></i>
                            <span class="text-gray-600 text-sm">{{ $work->user->company_size }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Related Jobs -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Related Jobs</h3>
                    @php
                        $relatedJobs = \App\Models\Work::where('category_id', $work->category_id)
                            ->where('id', '!=', $work->id)
                            ->where('status', 'active')
                            ->limit(3)
                            ->get();
                    @endphp
                    
                    @if($relatedJobs->count() > 0)
                        <div class="space-y-4">
                            @foreach($relatedJobs as $job)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <h4 class="font-medium text-gray-800 mb-1">{{ $job->title }}</h4>
                                <p class="text-sm text-gray-600 mb-2">{{ $job->user->name }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-500">{{ $job->location }}</span>
                                    <a href="{{ route('job.detail', $job->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">No related jobs found.</p>
                    @endif
                </div>

              
            </div>
        </div>
    </div>
</div>
@endsection
