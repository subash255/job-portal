@extends('layouts.app')
@section('content')
    <style>
        /* Custom styles for form elements */
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #4F46E5;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
    </style>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div id="flash-message" class="bg-green-500 text-white px-6 py-3 rounded-lg fixed top-4 right-4 shadow-lg z-50 flex items-center">
            <i class="ri-check-circle-line mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="flash-error" class="bg-red-500 text-white px-6 py-3 rounded-lg fixed top-4 right-4 shadow-lg z-50 flex items-center">
            <i class="ri-error-warning-line mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <script>
        // Auto-hide flash messages
        if (document.getElementById('flash-message')) {
            setTimeout(() => {
                const msg = document.getElementById('flash-message');
                msg.style.opacity = 0;
                msg.style.transition = "opacity 0.5s ease-out";
                setTimeout(() => msg.remove(), 500);
            }, 3000);
        }
        if (document.getElementById('flash-error')) {
            setTimeout(() => {
                const msg = document.getElementById('flash-error');
                msg.style.opacity = 0;
                msg.style.transition = "opacity 0.5s ease-out";
                setTimeout(() => msg.remove(), 500);
            }, 3000);
        }
    </script>

    <div class="p-6 bg-white shadow-lg -mt-12 mx-4 z-20 rounded-lg">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Category</h1>
                <p class="text-gray-600">Update category information and settings</p>
            </div>
            <a href="{{ route('category.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300">
                <i class="ri-arrow-left-line mr-2"></i>
                Back to Categories
            </a>
        </div>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center mb-2">
                    <i class="ri-error-warning-line text-red-500 text-lg mr-2"></i>
                    <h3 class="text-red-800 font-medium">Please correct the following errors:</h3>
                </div>
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center">
                            <i class="ri-close-circle-line text-red-500 text-sm mr-2"></i>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Form -->
        <div class="bg-gray-50 rounded-lg p-6">
            <form action="{{ route('category.update', $category->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('POST')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-gray-700">
                            <i class="ri-folder-line mr-1"></i>
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $category->name) }}"
                               placeholder="Enter category name"
                               class="form-input w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}"
                               required>
                        @error('name')
                            <p class="text-red-600 text-sm flex items-center mt-1">
                                <i class="ri-error-warning-line mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="text-gray-500 text-xs">This will be displayed as the category title</p>
                    </div>

                    <!-- Category Slug -->
                    <div class="space-y-2">
                        <label for="slug" class="block text-sm font-semibold text-gray-700">
                            <i class="ri-link mr-1"></i>
                            Category Slug <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug', $category->slug) }}"
                               placeholder="category-slug"
                               class="form-input w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 {{ $errors->has('slug') ? 'border-red-500' : 'border-gray-300' }}"
                               required>
                        @error('slug')
                            <p class="text-red-600 text-sm flex items-center mt-1">
                                <i class="ri-error-warning-line mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="text-gray-500 text-xs">URL-friendly version (lowercase, hyphens only)</p>
                    </div>
                </div>

                <!-- Category Status -->
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="ri-toggle-line mr-1"></i>
                        Category Status
                    </label>
                    <div class="flex items-center space-x-4">
                        <label class="toggle-switch">
                            <input type="checkbox" 
                                   name="status" 
                                   value="1" 
                                   {{ old('status', $category->status) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700">Active Status</span>
                            <span class="text-xs text-gray-500">Enable or disable this category</span>
                        </div>
                    </div>
                </div>

                <!-- Category Information Card -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <i class="ri-information-line text-blue-500 text-lg mt-0.5"></i>
                        <div>
                            <h4 class="text-blue-800 font-medium mb-1">Category Information</h4>
                            <div class="text-sm text-blue-700 space-y-1">
                                <p><strong>Created:</strong> {{ $category->created_at->format('M d, Y \a\t g:i A') }}</p>
                                <p><strong>Last Updated:</strong> {{ $category->updated_at->format('M d, Y \a\t g:i A') }}</p>
                                <p><strong>Current Status:</strong> 
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $category->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        <i class="ri-{{ $category->status ? 'check' : 'close' }}-circle-line mr-1"></i>
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex space-x-3">
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 transform hover:scale-105">
                            <i class="ri-save-line mr-2"></i>
                            Update Category
                        </button>
                        
                        <a href="{{ route('category.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-400 transition duration-300">
                            <i class="ri-close-line mr-2"></i>
                            Cancel
                        </a>
                    </div>

                    <!-- Delete Button -->
                    <button type="button" 
                            onclick="confirmDelete({{ $category->id }})"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-300">
                        <i class="ri-delete-bin-line mr-2"></i>
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex items-center mb-4">
                <i class="ri-error-warning-line text-red-500 text-2xl mr-3"></i>
                <h3 class="text-lg font-semibold text-gray-800">Confirm Deletion</h3>
            </div>
            <p class="text-gray-600 mb-6">
                Are you sure you want to delete the category "<strong>{{ $category->name }}</strong>"? 
                This action cannot be undone and may affect associated job listings.
            </p>
            <div class="flex space-x-3 justify-end">
                <button type="button" 
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-300">
                    Cancel
                </button>
                <form id="deleteForm" method="GET" class="inline">
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300">
                        <i class="ri-delete-bin-line mr-1"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-generate slug from name
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value;
            const slug = name.toLowerCase()
                            .replace(/[^a-z0-9 -]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-')
                            .trim('-');
            document.getElementById('slug').value = slug;
        });

        // Delete confirmation functions
        function confirmDelete(categoryId) {
            const deleteUrl = "{{ route('category.delete', ':id') }}".replace(':id', categoryId);
            document.getElementById('deleteForm').action = deleteUrl;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const slug = document.getElementById('slug').value.trim();
            
            if (!name || !slug) {
                e.preventDefault();
                alert('Please fill in all required fields.');
                return false;
            }
            
            // Basic slug validation
            if (!/^[a-z0-9-]+$/.test(slug)) {
                e.preventDefault();
                alert('Slug must contain only lowercase letters, numbers, and hyphens.');
                return false;
            }
        });
    </script>
@endsection