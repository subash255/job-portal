@extends('layouts.master')
@section('content')
    <div class="bg-gradient-to-b from-purple-500 via-purple-300 to-purple-100 min-h-screen py-12 xl:px-16 lg:px-12 sm:px-8 px-4 flex items-center justify-center">
        <div class="xl:max-w-6xl w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <img class="w-full lg:block hidden" src="{{ asset('images/about.svg') }}" alt="About Image">
                <div class="bg-gray-100 py-12 px-8 sm:px-16 rounded-md w-full">
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold">About Us</h1>
                        <p class="mt-2 text-lg">Learn more about our mission and values.</p>
                    </div>
                    <div class="mt-6">
                        <p class="text-base text-gray-700">We are dedicated to connecting job seekers with employers, providing a platform that simplifies the job search process.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection