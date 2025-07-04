@extends('layouts.master')
@section('content')

   
    <!-- Hero Section -->
    <section class="text-center py-16 px-4">
      <h2 class="text-4xl md:text-5xl font-extrabold mb-4 text-gray-900">Find Your Dream Job</h2>
      <p class="text-lg text-gray-600 mb-8">
        Connect with top employers and discover opportunities that match your skills and career goals.
      </p>
      
      <!-- Search Form -->
      <div class="max-w-4xl mx-auto">
        <form class="flex flex-col md:flex-row gap-4 items-center justify-center bg-white p-6 rounded-lg shadow-lg border">
          <div class="flex-1 w-full md:w-auto relative">
            <label for="job-title" class="sr-only">Job Title</label>
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v.5M8 6V4m0 2v.5m0 0V21l4-3 4 3V6.5"></path>
              </svg>
            </div>
            <input type="text" id="job-title" name="job_title" placeholder="Enter job title (e.g., Software Engineer, Marketing Manager)" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          </div>
          
          <div class="flex-1 w-full md:w-auto relative">
            <label for="location" class="sr-only">Location</label>
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <input type="text" id="location" name="location" placeholder="Enter location" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          </div>
          
          <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 flex items-center gap-2 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Search Jobs
          </button>
        </form>
      </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="bg-white py-8">
  <div class="max-w-7xl mx-auto px-4">
    <h2 class="text-2xl font-semibold mb-6 border-b-4 border-indigo-400 inline-block">Featured Jobs</h2>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      
      <!-- Card -->
      <div class="bg-indigo-50 rounded-lg shadow p-5 flex flex-col justify-between">
        <div class="flex items-center mb-3">
          <img src="https://via.placeholder.com/48" alt="Company Logo" class="w-12 h-12 rounded mr-3">
          <div>
            <h3 class="font-semibold text-lg">Executive Assistant To Director</h3>
            <p class="text-gray-500 text-sm">We Care Health Center</p>
            <p class="text-gray-500 text-sm">Naxal, Bhagwatibahal</p>
          </div>
        </div>
        <div class="mt-4 flex flex-wrap gap-2">
          <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded-full">Full Time</span>
          <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded-full">Mid Level</span>
        </div>
      </div>
      
      <!-- Repeat above card for other featured jobs -->
      <div class="bg-indigo-50 rounded-lg shadow p-5 flex flex-col justify-between">
        <div class="flex items-center mb-3">
          <img src="https://via.placeholder.com/48" alt="Company Logo" class="w-12 h-12 rounded mr-3">
          <div>
            <h3 class="font-semibold text-lg">Office Secretary</h3>
            <p class="text-gray-500 text-sm">EG Group of Companies</p>
            <p class="text-gray-500 text-sm">Lazimpath</p>
          </div>
        </div>
        <div class="mt-4 flex flex-wrap gap-2">
          <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded-full">Full Time</span>
          <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded-full">Senior Level</span>
        </div>
      </div>
      
      <!-- Add more cards as needed -->

    </div>
  </div>
</section>



    <!-- Features Section -->
<section class="max-w-7xl mx-auto px-4 py-16">
  <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
    Why Choose <span class="text-purple-600">JobPortal</span>
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


        <!-- Jobs Section -->
    <section class="bg-indigo-50 py-8">
  <div class="max-w-7xl mx-auto px-4">
    <h2 class="text-2xl font-semibold mb-6 border-b-4 border-indigo-400 inline-block">Job Vacancy In Nepal</h2>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      
      <!-- Card -->
      <div class="bg-white rounded-lg shadow p-5 flex flex-col justify-between">
        <div>
          <div class="flex items-center mb-3">
            <img src="https://via.placeholder.com/48" alt="Company Logo" class="w-12 h-12 rounded mr-3">
            <div>
              <h3 class="font-semibold text-lg">Finance Technical Writer/Designer</h3>
              <p class="text-gray-500 text-sm">Appharu Pvt Ltd</p>
            </div>
          </div>
          <div class="text-gray-600 text-sm space-y-1">
            <div class="flex items-center"><span class="material-icons mr-1 text-indigo-400">work_outline</span> Fresher</div>
            <div class="flex items-center"><span class="material-icons mr-1 text-indigo-400">place</span> Mid Baneshwor</div>
            <div class="flex items-center"><span class="material-icons mr-1 text-indigo-400">attach_money</span> Nrs. 30K-40K</div>
          </div>
        </div>
        <div class="flex justify-between items-center mt-4">
          <span class="text-sm text-gray-500">14 days left</span>
          <a href="#" class="text-indigo-500 hover:underline font-medium">View Detail</a>
        </div>
      </div>
      

      <div class="bg-white rounded-lg shadow p-5 flex flex-col justify-between">
        <div>
          <div class="flex items-center mb-3">
            <img src="https://via.placeholder.com/48" alt="Company Logo" class="w-12 h-12 rounded mr-3">
            <div>
              <h3 class="font-semibold text-lg">Senior Barista</h3>
              <p class="text-gray-500 text-sm">Seven to Nine Coffee</p>
            </div>
          </div>
          <div class="text-gray-600 text-sm space-y-1">
            <div class="flex items-center"><span class="material-icons mr-1 text-indigo-400">work</span> 2+ years</div>
            <div class="flex items-center"><span class="material-icons mr-1 text-indigo-400">place</span> Hattisar</div>
            <div class="flex items-center"><span class="material-icons mr-1 text-indigo-400">attach_money</span> Nrs. Monthly</div>
          </div>
        </div>
        <div class="flex justify-between items-center mt-4">
          <span class="text-sm text-gray-500">14 days left</span>
          <a href="#" class="text-indigo-500 hover:underline font-medium">View Detail</a>
        </div>
      </div>
      

    </div>
  </div>
</section>

@endsection
