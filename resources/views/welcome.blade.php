@extends('layouts.master')
@section('content')

    <!-- Job Listings -->
    <main class="container mx-auto mt-8 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Job Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold">Frontend Developer</h2>
                <p class="text-gray-600">TechCorp · Remote</p>
                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Apply Now
                </button>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold">Backend Developer</h2>
                <p class="text-gray-600">CodeBase · New York</p>
                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Apply Now
                </button>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold">Full Stack Developer</h2>
                <p class="text-gray-600">DevWorks · San Francisco</p>
                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Apply Now
                </button>
            </div>

        </div>
    </main>

@endsection
