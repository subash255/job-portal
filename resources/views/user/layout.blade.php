@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                    <!-- User Profile Card -->
                    <div class="text-center mb-8">
                        <div class="relative inline-block">
                            <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) 
                                              : 'https://via.placeholder.com/100' }}"
                                alt="Profile Picture"
                                class="w-20 h-20 rounded-full mx-auto mb-4 object-cover ring-4 ring-indigo-100">

                            <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 rounded-full ring-2 ring-white"></div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ auth()->user()->email }}</p>
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="space-y-2">
                        <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 {{ request()->routeIs('user.profile') ? 'bg-indigo-50 text-indigo-600 border-r-2 border-indigo-600' : '' }}">
                            <i class="ri-user-line text-lg"></i>
                            <span class="font-medium">My Profile</span>
                        </a>



                        <a href="{{ route('user.my-jobs') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 {{ request()->routeIs('user.my-jobs') ? 'bg-indigo-50 text-indigo-600 border-r-2 border-indigo-600' : '' }}">
                            <i class="ri-briefcase-line text-lg"></i>
                            <span class="font-medium">My Applications</span>
                        </a>

                        <a href="{{ route('user.settings') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 {{ request()->routeIs('user.settings') ? 'bg-indigo-50 text-indigo-600 border-r-2 border-indigo-600' : '' }}">
                            <i class="ri-settings-3-line text-lg"></i>
                            <span class="font-medium">Settings</span>
                        </a>

                        <div class="border-t pt-4 mt-6">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 px-4 py-3 text-red-600 rounded-lg hover:bg-red-50 transition-colors duration-200 w-full text-left">
                                    <i class="ri-logout-box-line text-lg"></i>
                                    <span class="font-medium">Logout</span>
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:w-3/4">
                @yield('user-content')
            </div>
        </div>
    </div>
</div>
@endsection