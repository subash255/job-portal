@extends('layouts.master')
@section('content')

<!-- Hero Section with Search -->
<section style="background-image: url('/images/back.jpg');" class="relative text-center py-16 px-4 bg-cover bg-center bg-no-repeat">
    <div class="absolute inset-0 bg-black bg-opacity-30 z-0"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-gray-900">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-8 drop-shadow-lg">Find Your Dream Job</h2>

        <!-- Search Form -->
        <div class="max-w-4xl mx-auto">
            <form class="flex flex-col md:flex-row gap-4 items-center justify-center bg-white p-6 rounded-lg shadow-lg border">

                <div class="flex-1 w-full md:w-auto relative">
                    <label for="job-title" class="sr-only">Job Title</label>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="ri-briefcase-line text-lg"></i>
                    </div>
                    <input type="text" id="job-title" name="job_title" placeholder="Enter job title (e.g., Software Engineer, Marketing Manager)" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <div class="flex-1 w-full md:w-auto relative">
                    <label for="location" class="sr-only">Location</label>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="ri-map-pin-line text-lg"></i>
                    </div>
                    <input type="text" id="location" name="location" placeholder="Enter location" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 flex items-center gap-2 font-semibold">
                    <i class="ri-search-line w-5 h-5"></i>
                    Search Jobs
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Job Listings Section -->
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Filter Sidebar -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Filter Jobs</h3>

                    <!-- Job Type Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 mb-3">Job Type</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Full Time</span>
                                <span class="ml-auto text-xs text-gray-400">(24)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Part Time</span>
                                <span class="ml-auto text-xs text-gray-400">(8)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Contract</span>
                                <span class="ml-auto text-xs text-gray-400">(12)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Freelance</span>
                                <span class="ml-auto text-xs text-gray-400">(6)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Experience Level Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 mb-3">Experience Level</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Entry Level</span>
                                <span class="ml-auto text-xs text-gray-400">(15)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Mid Level</span>
                                <span class="ml-auto text-xs text-gray-400">(18)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Senior Level</span>
                                <span class="ml-auto text-xs text-gray-400">(12)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Salary Range Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 mb-3">Salary Range</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Under 30K</span>
                                <span class="ml-auto text-xs text-gray-400">(8)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">30K - 50K</span>
                                <span class="ml-auto text-xs text-gray-400">(15)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">50K - 80K</span>
                                <span class="ml-auto text-xs text-gray-400">(12)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">80K+</span>
                                <span class="ml-auto text-xs text-gray-400">(7)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Location Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 mb-3">Location</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Kathmandu</span>
                                <span class="ml-auto text-xs text-gray-400">(35)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Lalitpur</span>
                                <span class="ml-auto text-xs text-gray-400">(12)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Bhaktapur</span>
                                <span class="ml-auto text-xs text-gray-400">(8)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <span class="ml-2 text-sm text-gray-600">Pokhara</span>
                                <span class="ml-auto text-xs text-gray-400">(5)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    <button class="w-full bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300 transition-colors duration-200 font-medium">
                        Clear All Filters
                    </button>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="lg:w-3/4">
                <!-- Results Header -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Job Listings</h2>
                        <p class="text-gray-600">Showing 1-20 of 150 jobs</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Sort by:</span>
                        <select class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option>Latest</option>
                            <option>Salary: High to Low</option>
                            <option>Salary: Low to High</option>
                            <option>Experience</option>
                        </select>
                    </div>
                </div>

                <!-- Job Cards -->
                <div class="space-y-6">
                    @foreach ($works as $work)
                    <!-- Job Card 1 -->
 <form action="{{ route('work.apply', $work->id) }}" method="post">
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 border border-gray-200">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <img src="images/7.jpeg" alt="Company Logo" class="w-14 h-14 rounded-lg object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 hover:text-indigo-600 transition-colors duration-200">
                                        <a href="#" class="cursor-pointer">{{$work->title}}</a>
                                    </h3>
                                    <p class="text-gray-600 font-medium mb-2">{{$work->user->name}}</p>
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <i class="ri-map-pin-line mr-1 text-gray-500"></i>
                                            {{$work->location,$work->user->state}}
                                        </div>
                                        <div class="flex items-center">
                                            <i class="ri-time-line mr-1 text-gray-500"></i>
                                            {{($work->created_at)->diffForHumans() }}
                                        </div>
                                        <div class="flex items-center">
                                            <i class="ri-money-dollar-circle-line mr-1 text-gray-500"></i>
                                            {{$work->salary}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="mb-4">
                                    <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-medium">Featured</span>
                                </div>
                            
                               

                                    @csrf
                                    <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold">
                                        Apply Now
                                    </button>
                                   
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex space-x-2">
                                <span class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full font-medium">{{$work->type}}</span>
                                <span class="bg-purple-100 text-purple-700 text-xs px-3 py-1 rounded-full font-medium">{{$work->position}}</span>
                                <span class="bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full font-medium">Onsite</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <button class="text-gray-500 hover:text-red-500 transition-colors duration-200">
                                    <i class="ri-heart-line text-xl"></i>
                                </button>
                                <button class="text-gray-500 hover:text-indigo-500 transition-colors duration-200">
                                    <i class="ri-share-line text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                    

                    @endforeach

                </div>


                <!-- Pagination -->
                <div class="flex items-center justify-center mt-12">
                    <nav class="flex items-center space-x-2">
                        <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors duration-200">
                            Previous
                        </button>
                        <button class="px-3 py-2 text-sm font-medium text-white bg-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-700 transition-colors duration-200">
                            1
                        </button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors duration-200">
                            2
                        </button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors duration-200">
                            3
                        </button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors duration-200">
                            Next
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection