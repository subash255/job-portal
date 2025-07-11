@extends('layouts.master')

@section('content')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<section style="background-image: url('/images/back.jpg');"
    class="relative text-center py-16 px-4 bg-cover bg-center bg-no-repeat">
    <div class="absolute inset-0 bg-black bg-opacity-30 z-0"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-gray-900">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-8 drop-shadow-lg">Find Your Dream Job</h2>
        <div class="max-w-4xl mx-auto">
            <form method="GET" action="{{ route('job') }}"
                class="flex flex-col md:flex-row gap-4 items-center justify-center bg-white p-6 rounded-lg shadow-lg border">

                <div class="flex-1 w-full md:w-auto relative">
                    <label for="job-title" class="sr-only">Job Title</label>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="ri-briefcase-line text-lg"></i>
                    </div>
                    <input type="text" id="job-title" name="search" value="{{ request('search') }}"
                        placeholder="Enter job title (e.g., Software Engineer, Marketing Manager)"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <div class="flex-1 w-full md:w-auto relative">
                    @php $selectedSingleType = is_array(request('type')) ? '' : request('type'); @endphp
                    <label for="job-type" class="sr-only">Job Type</label>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="ri-briefcase-4-line text-lg"></i>
                    </div>
                    <select id="job-type" name="type"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                        <option value="">Select job type</option>
                        <option value="Full-Time" {{ $selectedSingleType === 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                        <option value="Part-Time" {{ $selectedSingleType === 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                        <option value="Contract" {{ $selectedSingleType === 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Internship" {{ $selectedSingleType === 'Internship' ? 'selected' : '' }}>Internship</option>
                        <option value="Freelance" {{ $selectedSingleType === 'Freelance' ? 'selected' : '' }}>Freelance</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 flex items-center gap-2 font-semibold">
                    <i class="ri-search-line w-5 h-5"></i> Search Jobs
                </button>
            </form>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Filter Jobs</h3>
                    <form method="GET" action="{{ route('job') }}" id="filterForm">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-700 mb-3">Job Type</h4>
                            <div class="space-y-2">
                                @php
                                    $selectedTypes = request('type', []);
                                    if (!is_array($selectedTypes)) $selectedTypes = [$selectedTypes];
                                @endphp
                                @foreach(['Full-Time', 'Part-Time', 'Contract', 'Internship', 'Freelance'] as $type)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="type[]" value="{{ $type }}" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 filter-checkbox" {{ in_array($type, $selectedTypes) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-600">{{ $type }}</span>
                                        <span class="ml-auto text-xs text-gray-400">({{ $jobTypeCounts[$type] ?? 0 }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-700 mb-3">Category</h4>
                            <div class="space-y-2">
                                @php $selectedCats = request('category', []); @endphp
                                @foreach($categories as $category)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="category[]" value="{{ $category->id }}" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 filter-checkbox" {{ in_array($category->id, $selectedCats) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-600">{{ $category->name }}</span>
                                        <span class="ml-auto text-xs text-gray-400">({{ $category->works_count ?? 0 }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button type="button" onclick="clearFilters()"
                                class="flex-1 bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300 transition-colors duration-200 font-medium">
                                Clear Filters
                            </button>
                            <button type="submit"
                                class="flex-1 bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition-colors duration-200 font-medium">
                                Apply
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:w-3/4">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Job Listings</h2>
                        <p class="text-gray-600">
                            Showing {{ $works->firstItem() ?? 0 }}-{{ $works->lastItem() ?? 0 }} of {{ $works->total() ?? 0 }} jobs
                            @if(request('search'))
                                for "<strong>{{ request('search') }}</strong>"
                            @endif
                            @php $summaryTypes = (array) request('type'); @endphp
                            @if($summaryTypes)
                                in "<strong>{{ implode(', ', $summaryTypes) }}</strong>" jobs
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Sort by:</span>
                        <form method="GET" action="{{ route('job') }}" class="inline">
                            @foreach(request()->except(['sort','page']) as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $item)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            @php $sort = request('sort','latest'); @endphp
                            <select name="sort" onchange="this.form.submit()" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest</option>
                                <option value="title_asc" {{ $sort === 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                                <option value="title_desc" {{ $sort === 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                                <option value="company" {{ $sort === 'company' ? 'selected' : '' }}>Company</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="space-y-6">
    @forelse ($works as $work)
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 border border-gray-200">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-4 flex-1 pr-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                        @if ($work->user->profile_picture)
                            <img src="{{ asset('storage/' . $work->user->profile_picture) }}"
                                alt="{{ $work->user->name }} Logo"
                                class="w-14 h-14 rounded-lg object-cover">
                        @else
                            <i class="ri-building-line text-2xl text-white"></i>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-xl font-bold text-gray-800 hover:text-indigo-600 transition-colors duration-200 mb-1">
                            <a href="{{ route('job.detail', $work->id) }}" class="cursor-pointer">{{ $work->title }}</a>
                        </h3>
                        <p class="text-gray-600 font-medium mb-2">{{ $work->user->name }}</p>
                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-3 flex-wrap">
                            <div class="flex items-center">
                                <i class="ri-map-pin-line mr-1 text-gray-500"></i>
                                {{ $work->location }}{{ $work->user->state ? ', ' . $work->user->state : '' }}
                            </div>
                            <div class="flex items-center">
                                <i class="ri-time-line mr-1 text-gray-500"></i>
                                {{ $work->created_at->diffForHumans() }}
                            </div>
                            @if($work->salary)
                                <div class="flex items-center">
                                    <i class="ri-money-dollar-circle-line mr-1 text-gray-500"></i>
                                    NPR {{ $work->salary }}
                                </div>
                            @endif
                            @if($work->end_date)
                                <div class="flex items-center">
                                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-medium flex items-center">
                                        <i class="ri-calendar-line mr-1"></i>
                                        Deadline: {{ \Carbon\Carbon::parse($work->end_date)->format('M d, Y') }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        @if($work->description)
                            <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ Str::limit($work->description, 150) }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col items-end justify-start space-y-3 flex-shrink-0">
                    <div>
                        @if($work->status == 'active')
                            <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-medium">Active</span>
                        @else
                            <span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full font-medium">{{ ucfirst($work->status) }}</span>
                        @endif
                    </div>
                    <a href="{{ route('job.detail', $work->id) }}"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold whitespace-nowrap">
                        View Details
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex space-x-2">
                    <span class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full font-medium">{{ ucfirst($work->type) }}</span>
                    <span class="bg-purple-100 text-purple-700 text-xs px-3 py-1 rounded-full font-medium">{{ $work->position }}</span>
                    <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-medium">{{ $work->category->name ?? 'General' }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ri-search-line text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Jobs Found</h3>
            <p class="text-gray-600 mb-4">
                @if(request()->hasAny(['search', 'type', 'category']))
                    No jobs match your current search criteria. Try adjusting your filters.
                @else
                    There are no job listings available at the moment.
                @endif
            </p>
            @if(request()->hasAny(['search', 'type', 'category']))
                <a href="{{ route('job') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-medium">
                    Clear All Filters
                </a>
            @endif
        </div>
    @endforelse
</div>


                @if($works->hasPages())
                <div class="flex items-center justify-center mt-12">
                    <nav class="flex items-center space-x-2">
                        {{ $works->appends(request()->input())->links() }}
                    </nav>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.filter-checkbox').forEach(cb => cb.addEventListener('change', () => document.getElementById('filterForm').submit()));
    function clearFilters() {
        document.querySelectorAll('.filter-checkbox').forEach(cb => cb.checked = false);
        document.querySelector('input[name="search"]').value = '';
        document.querySelector('select[name="type"]').value = '';
        window.location.href = '{{ route("job") }}';
    }
</script>
@endsection
