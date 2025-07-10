@extends('layouts.company')
@section('content')
<div class="bg-gray-100 min-h-screen py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white p-10 rounded-xl shadow-md border border-gray-200">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Post a New Job</h2>

        <form action="{{route('work.store')}}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Job Title -->
                <div>
                    <label for="title" class="block text-gray-700 font-semibold mb-1">Job Title</label>
                    <input type="text" id="title" name="title" placeholder="e.g. Laravel Developer"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <!-- Category-->
                <div>
                    <label for="category_id" class="block text-gray-700 font-semibold mb-1">Category</label>
                    <select id="category_id" name="category_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-gray-700 font-semibold mb-1">Position</label>
                    <select id="position" name="position"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Select position</option>
                        <option value="senior">senior </option>
                        <option value="mid-level">mid-level</option>
                        <option value="junior">junior</option>
                        <option value="intern">intern</option>
                    </select>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-gray-700 font-semibold mb-1">Location</label>
                    <input type="text" id="location" name="location" placeholder="e.g. Kathmandu"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Job Type -->
                <div>
                    <label for="type" class="block text-gray-700 font-semibold mb-1">Job Type</label>
                    <select id="type" name="type"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Select type</option>
                        <option value="full-time">Full-time</option>
                        <option value="part-time">Part-time</option>
                        <option value="internship">Internship</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>

                <!-- Salary -->
                <div>
                    <label for="salary" class="block text-gray-700 font-semibold mb-1">Salary (Optional)</label>
                    <input type="text" id="salary" name="salary" placeholder="e.g. 25,000 - 40,000"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- End Date -->
                <div>
                    <label for="end_date" class="block text-gray-700 font-semibold mb-1">Application End Date</label>
                    <input type="date" id="end_date" name="end_date" min="{{ date('Y-m-d') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-gray-700 font-semibold mb-1">Status</label>
                    <select id="status" name="status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="active">Active</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>

                <!-- Empty space for symmetry -->
                <div></div>
            </div>

            <!-- Job Description (full width) -->
            <div class="mt-6">
                <label for="description" class="block text-gray-700 font-semibold mb-1">Job Description</label>
                <textarea id="description" name="description" rows="5" placeholder="Describe the job responsibilities..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                    Post Job
                </button>
            </div>
        </form>
    </div>
</div>

@endsection