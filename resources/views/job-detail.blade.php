@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('welcome') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                <i class="ri-arrow-left-line mr-2"></i>Back to Jobs
            </a>
        </div>

        <!-- Job Header -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <img src="{{ asset('images/5.png') }}" alt="Company Logo" class="w-14 h-14 rounded-lg object-cover">
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $work->title }}</h1>
                        <p class="text-lg text-gray-600 mb-1">{{ $work->user->name }}</p>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span><i class="ri-map-pin-line mr-1"></i>{{ $work->location }}</span>
                            <span><i class="ri-time-line mr-1"></i>{{ $work->type }}</span>
                            <span><i class="ri-money-dollar-circle-line mr-1"></i>{{ $work->salary }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    @if($work->status == 'active')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                            <i class="ri-pulse-line mr-1"></i>Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                            <i class="ri-close-circle-line mr-1"></i>Closed
                        </span>
                    @endif
                    <p class="text-sm text-gray-500 mt-2">
                        Deadline: {{ $work->end_date ? $work->end_date->format('M d, Y') : 'Not specified' }}
                    </p>
                </div>
            </div>

            <!-- Job Tags -->
            <div class="flex flex-wrap gap-2 mb-6">
                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-medium">{{ $work->type }}</span>
                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-medium">{{ $work->position }}</span>
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">{{ $work->category->name }}</span>
            </div>

            <!-- Apply Button -->
            <div class="border-t pt-6">
                @auth
                    @if(auth()->user()->role == 'user')
                        <a href="{{ route('work.apply.form', $work->id) }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold inline-flex items-center">
                            <i class="ri-send-plane-line mr-2"></i>Apply for this Position
                        </a>
                    @else
                        <p class="text-gray-500 italic">Only job seekers can apply for positions.</p>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold inline-flex items-center">
                        <i class="ri-login-circle-line mr-2"></i>Login to Apply
                    </a>
                @endauth
            </div>
        </div>

        <!-- Job Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Job Description -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Job Description</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-600 leading-relaxed">{{ $work->description }}</p>
                    </div>
                </div>

                <!-- Responsibilities -->
                @if($work->responsibility)
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Responsibilities</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-600 leading-relaxed">{{ $work->responsibility }}</p>
                    </div>
                </div>
                @endif

                <!-- Requirements -->
                @if($work->expected_requirement)
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Requirements</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-600 leading-relaxed">{{ $work->expected_requirement }}</p>
                    </div>
                </div>
                @endif

                <!-- Benefits -->
                @if($work->benefits)
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Benefits</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-600 leading-relaxed">{{ $work->benefits }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Job Summary -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Job Summary</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <i class="ri-briefcase-line text-indigo-500 mt-1"></i>
                            <div>
                                <p class="font-medium text-gray-800">Position</p>
                                <p class="text-gray-600">{{ $work->position }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="ri-time-line text-indigo-500 mt-1"></i>
                            <div>
                                <p class="font-medium text-gray-800">Employment Type</p>
                                <p class="text-gray-600">{{ $work->type }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="ri-map-pin-line text-indigo-500 mt-1"></i>
                            <div>
                                <p class="font-medium text-gray-800">Location</p>
                                <p class="text-gray-600">{{ $work->location }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="ri-money-dollar-circle-line text-indigo-500 mt-1"></i>
                            <div>
                                <p class="font-medium text-gray-800">Salary</p>
                                <p class="text-gray-600">{{ $work->salary ?: 'Negotiable' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="ri-calendar-line text-indigo-500 mt-1"></i>
                            <div>
                                <p class="font-medium text-gray-800">Application Deadline</p>
                                <p class="text-gray-600">{{ $work->end_date ? $work->end_date->format('M d, Y') : 'Not specified' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="ri-calendar-2-line text-indigo-500 mt-1"></i>
                            <div>
                                <p class="font-medium text-gray-800">Posted</p>
                                <p class="text-gray-600">{{ $work->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Info -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">About Company</h3>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/5.png') }}" alt="Company Logo" class="w-10 h-10 rounded-lg object-cover">
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $work->user->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $work->user->email }}</p>
                        </div>
                    </div>
                    @if($work->user->description)
                    <p class="text-gray-600 text-sm">{{ $work->user->description }}</p>
                    @endif
                </div>

                <!-- Share Job -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Share This Job</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="flex items-center justify-center w-10 h-10 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center w-10 h-10 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors">
                            <i class="ri-twitter-fill"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center w-10 h-10 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors">
                            <i class="ri-linkedin-fill"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center w-10 h-10 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                            <i class="ri-whatsapp-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
