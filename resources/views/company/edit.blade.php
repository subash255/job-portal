@extends('layouts.company')
@section('title', 'Edit Job - Job Point')
@section('content')

<!-- Edit Job Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Job</h1>
            <p class="text-gray-600 mt-1">Update your job posting details</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('company.jobs') }}" class="bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-700 transition-all duration-200">
                <i class="ri-arrow-left-line mr-2"></i>Back to Jobs
            </a>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto">
    <form action="{{ route('company.jobs.update', $work->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')
        
        <!-- Job Details Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Job Details</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $work->title) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select id="category_id" name="category_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                            required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $work->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                    <input type="text" id="position" name="position" value="{{ old('position', $work->position) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                           required>
                    @error('position')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $work->location) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                           required>
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Job Type</label>
                    <select id="type" name="type" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                            required>
                        <option value="">Select job type</option>
                        <option value="Full-time" {{ old('type', $work->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ old('type', $work->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Contract" {{ old('type', $work->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Internship" {{ old('type', $work->type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">Salary Range</label>
                    <input type="text" id="salary" name="salary" value="{{ old('salary', $work->salary) }}" 
                           placeholder="e.g., Rs. 50,000 - 80,000"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('salary')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Application Deadline</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $work->end_date ? $work->end_date->format('Y-m-d') : '') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                           required>
                    @error('end_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" name="status" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                            required>
                        <option value="active" {{ old('status', $work->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="closed" {{ old('status', $work->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Job Description</label>
                <textarea id="description" name="description" rows="6" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                          placeholder="Describe the job responsibilities, requirements, and qualifications..." 
                          required>{{ old('description', $work->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('company.jobs') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="ri-save-line mr-2"></i>Update Job
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
