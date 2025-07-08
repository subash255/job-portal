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



<!-- Filter and Search -->
<div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 mb-8">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex flex-col md:flex-row gap-4 flex-1">
            <div class="relative">
                <input type="text" placeholder="Search jobs..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option>All Status</option>
                <option>Active</option>
                <option>Draft</option>
                <option>Closed</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option>All Categories</option>
                <option>Technology</option>
                <option>Marketing</option>
                <option>Design</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="ri-filter-line mr-2"></i>Filter
            </button>

        </div>
    </div>
</div>

<!-- Jobs List -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100">
    <div class="p-6 border-b border-gray-100">
        <h3 class="text-xl font-bold text-gray-800">Your Job Postings</h3>
    </div>
    
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
                        <form action="{{ route('company.jobs.delete', $work->id) }}" method="POST" class="inline" 
                              onsubmit="return confirm('Are you sure you want to delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" title="Delete Job">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
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
