@extends('layouts.master')
@section('content')
<!-- Hero Section -->
<section style="background-image: url('/images/back.jpg');" class="relative text-center py-16 px-4 bg-cover bg-center bg-no-repeat">
  <div class="absolute inset-0 bg-black bg-opacity-30 z-0"></div>
  <div class="relative z-10 max-w-4xl mx-auto text-gray-900">
    <h2 class="text-4xl md:text-5xl font-extrabold mb-8 drop-shadow-lg">Find Your Dream Job</h2>
    <p class="text-lg mb-24 drop-shadow-md">
      Connect with top employers and discover opportunities that match your skills and career goals.
    </p>

    <!-- Search Form -->
    <div class="max-w-4xl mx-auto">
      <form method="GET" action="{{ route('job') }}" class="flex flex-col md:flex-row gap-4 items-center justify-center bg-white p-6 rounded-lg shadow-lg border">

        <div class="flex-1 w-full md:w-auto relative">
          <label for="job-title" class="sr-only">Job Title</label>
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
            <i class="ri-briefcase-line text-lg"></i>
          </div>
          <input type="text" id="job-title" name="search" placeholder="Enter job title (e.g., Software Engineer, Marketing Manager)" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div class="flex-1 w-full md:w-auto relative">
          <label for="job-type" class="sr-only">Job Type</label>
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
            <i class="ri-briefcase-4-line text-lg"></i>
          </div>
          <select id="job-type" name="type" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
            <option value="">Select job type</option>
            <option value="Full-Time">Full-Time</option>
            <option value="Part-Time">Part-Time</option>
            <option value="Contract">Contract</option>
            <option value="Internship">Internship</option>
            <option value="Freelance">Freelance</option>
          </select>
        </div>

        <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 flex items-center gap-2 font-semibold">
          <i class="ri-search-line w-5 h-5"></i>
          Search Jobs
        </button>
      </form>
    </div>
  </div>
</section>


<!-- Featured Jobs Section -->
<section class="bg-gradient-to-br from-gray-50 to-indigo-50 py-16">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Featured Jobs</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">Discover top opportunities from leading companies</p>
    </div>

    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
      <!-- Featured Job Card 1 -->
      @foreach ($works as $work)
      <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-6 border-l-4 border-transparent hover:border-indigo-500 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>
        <div class="relative z-10">
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center space-x-3">
              <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                @if($work->user->profile_picture)
                  <img src="{{ asset('storage/' . $work->user->profile_picture) }}" alt="{{ $work->user->name }} Logo" class="w-12 h-12 rounded-lg object-cover">
                @else
                        <i class="ri-building-line text-4xl text-white"></i>
                @endif
              </div>
              <div>
                <h3 class="font-bold text-lg text-gray-800 group-hover:text-indigo-600 transition-colors duration-200">
                  {{$work->title}}
                </h3>
                <p class="text-gray-500 text-sm font-medium">{{$work->user->name}}</p>
              </div>
            </div>
            <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
              FEATURED
            </div>
          </div>

          <div class="space-y-2 mb-6">
            <div class="flex items-center text-gray-600 text-sm">
              <i class="ri-map-pin-2-fill text-indigo-500 w-4 h-4 mr-2"></i>
              {{$work->location }}
            </div>

          </div>

          <div class="flex items-center justify-between">
            <div class="flex space-x-2">
              <span class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full font-medium">
                {{$work->type}}</span>
              <span class="bg-purple-100 text-purple-700 text-xs px-3 py-1 rounded-full font-medium">
                {{$work->position}}</span>

            </div>
            <a href="{{ route('job.detail', $work->id) }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold text-sm group-hover:scale-105">
              View Details
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>

  </div>
</section>




<!-- Features Section -->
@guest
<section class="max-w-7xl mx-auto px-4 py-16">
  <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
    Why Choose <span class="text-purple-600">JobPoint?</span>
  </h2>

  <div class="grid gap-8 md:grid-cols-3">
    <!-- Card 1 -->
    <div class="bg-white/80 backdrop-blur rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-8">
      <h3 class="text-xl font-semibold text-purple-700 mb-4">For Job Seekers</h3>
      <ul class="text-gray-700 text-justify text-sm space-y-3">
        <li>✔️ Browse thousands of jobs</li>
        <li>✔️ Apply with just a few clicks</li>
        <li>✔️ Track your applications</li>
        <li>✔️ Get matched to opportunities</li>
      </ul>
    </div>

    <!-- Card 2 -->
    <div class="bg-white/80 backdrop-blur rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-8">
      <h3 class="text-xl font-semibold text-purple-700 mb-4">For Employers</h3>
      <ul class="text-gray-700 text-justify text-sm space-y-3">
        <li>✔️ Post job openings easily</li>
        <li>✔️ Manage applications</li>
        <li>✔️ Find qualified talent</li>
        <li>✔️ Build your brand</li>
      </ul>
    </div>

    <!-- Card 3 -->
    <div class="bg-white/80 backdrop-blur rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-8">
      <h3 class="text-xl font-semibold text-purple-700 mb-4">How It Works</h3>
      <ol class="text-gray-700 text-justify text-sm space-y-3 list-decimal list-inside">
        <li>Create your account</li>
        <li>Complete your profile</li>
        <li>Browse or post jobs</li>
        <li>Apply or manage listings</li>
      </ol>
    </div>
  </div>
</section>
@endguest


<!-- Job Vacancy Section -->
<section class="bg-white py-16">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between mb-12">
      <div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Latest Job Vacancies</h2>
        <p class="text-lg text-gray-600">Explore recent job opportunities in Nepal</p>
      </div>
      <a href="{{ route('job') }}" class="hidden md:block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold">
        View All Jobs
      </a>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($latestWorks as $work)
      <!-- Job Card 1 -->
      <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 hover:scale-105 hover:border-indigo-200">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
              @if($work->user->profile_picture)
                <img src="{{ asset('storage/' . $work->user->profile_picture) }}" alt="{{ $work->user->name }} Logo" class="w-10 h-10 rounded-lg object-cover">
              @else
                <i class="ri-building-line text-4xl text-white"></i>
              @endif
            </div>
            <div>
              <h3 class="font-bold text-lg text-gray-800 hover:text-indigo-600 transition-colors duration-200">{{$work->title}}</h3>
              <p class="text-gray-500 text-sm font-medium">{{$work->user->name}}</p>
            </div>
          </div>
        </div>

        <div class="space-y-3 mb-6">
          <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-600 text-sm">
              <i class="ri-briefcase-line text-indigo-500 w-4 h-4 mr-2"></i> {{$work->position }}
            </div>
            @php
            $end = \Carbon\Carbon::parse($work->end_date); // Parse the end date
            @endphp
            <span class="bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full font-medium">{{ $end->diffForHumans() }}
            </span>
          </div>
          <div class="flex items-center text-gray-600 text-sm">
            <i class="ri-map-pin-line text-indigo-500 w-4 h-4 mr-2"></i> {{ $work->location }}
          </div>
          <div class="flex items-center text-gray-600 text-sm">
            <i class="ri-money-dollar-box-line text-indigo-500 w-4 h-4 mr-2"></i> 
            @if($work->salary)
              Nrs. {{$work->salary}}
            @else
              Negotiable
            @endif
          </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
          <div class="flex space-x-2">
            <span class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full font-medium">{{$work->type}}</span>
          </div>
          <a href="{{ route('job.detail', $work->id) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm hover:underline transition-colors duration-200">View Details →</a>
        </div>
      </div>

      
      @endforeach

    </div>

    <div class="text-center mt-12 md:hidden">
      <a href="{{ route('job') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold">
        View All Jobs
      </a>
    </div>
  </div>
</section>

@endsection