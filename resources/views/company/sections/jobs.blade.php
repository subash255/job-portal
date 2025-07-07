<!-- Jobs Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manage Jobs</h1>
            <p class="text-gray-600 mt-1">Create, edit, and manage your job postings</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('company.create') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="ri-add-line mr-2"></i>Post New Job
            </a>
        </div>
    </div>
</div>



<!-- Filter and Search -->
<div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 mb-8">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex flex-col md:flex-row gap-4 flex-1">
            <div class="relative">
                <input type="text" placeholder="Search jobs..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option>All Status</option>
                <option>Active</option>
                <option>Draft</option>
                <option>Closed</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option>All Categories</option>
                <option>Technology</option>
                <option>Marketing</option>
                <option>Design</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="ri-filter-line mr-2"></i>Filter
            </button>

        </div>
    </div>
</div>

<!-- Jobs List -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100">
    <div class="p-6 border-b border-gray-100">
        <h3 class="text-xl font-bold text-gray-800">Your Job Postings</h3>
    </div>
    
    <div class="divide-y divide-gray-100">
        <!-- Job Item -->
        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h4 class="text-lg font-semibold text-gray-800">Senior Frontend Developer</h4>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            <i class="ri-pulse-line mr-1"></i> Active
                        </span>
                    </div>
                    <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                        <span><i class="ri-map-pin-line mr-1"></i> Kathmandu, Nepal</span>
                        <span><i class="ri-money-dollar-circle-line mr-1"></i> Rs. 80,000 - 120,000</span>
                        <span><i class="ri-calendar-line mr-1"></i> Posted 2 days ago</span>
                    </div>
                    <p class="text-gray-600 text-sm line-clamp-2">We are looking for an experienced Frontend Developer to join our team and work on exciting projects...</p>
                </div>
                <div class="text-right ml-6">
                    <div class="mb-2">
                        <span class="text-2xl font-bold text-indigo-600">18</span>
                        <p class="text-sm text-gray-500">Applications</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 text-gray-400 hover:text-indigo-600 transition-colors rounded-lg hover:bg-indigo-50">
                            <i class="ri-eye-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-blue-600 transition-colors rounded-lg hover:bg-blue-50">
                            <i class="ri-edit-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Item -->
        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h4 class="text-lg font-semibold text-gray-800">Digital Marketing Manager</h4>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            <i class="ri-pulse-line mr-1"></i> Active
                        </span>
                    </div>
                    <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                        <span><i class="ri-map-pin-line mr-1"></i> Pokhara, Nepal</span>
                        <span><i class="ri-money-dollar-circle-line mr-1"></i> Rs. 60,000 - 90,000</span>
                        <span><i class="ri-calendar-line mr-1"></i> Posted 5 days ago</span>
                    </div>
                    <p class="text-gray-600 text-sm line-clamp-2">Join our marketing team and help us grow our brand presence across digital platforms...</p>
                </div>
                <div class="text-right ml-6">
                    <div class="mb-2">
                        <span class="text-2xl font-bold text-indigo-600">12</span>
                        <p class="text-sm text-gray-500">Applications</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 text-gray-400 hover:text-indigo-600 transition-colors rounded-lg hover:bg-indigo-50">
                            <i class="ri-eye-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-blue-600 transition-colors rounded-lg hover:bg-blue-50">
                            <i class="ri-edit-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Item -->
        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h4 class="text-lg font-semibold text-gray-800">Backend Developer</h4>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                            <i class="ri-time-line mr-1"></i> Draft
                        </span>
                    </div>
                    <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                        <span><i class="ri-map-pin-line mr-1"></i> Lalitpur, Nepal</span>
                        <span><i class="ri-money-dollar-circle-line mr-1"></i> Rs. 90,000 - 130,000</span>
                        <span><i class="ri-calendar-line mr-1"></i> Created 1 week ago</span>
                    </div>
                    <p class="text-gray-600 text-sm line-clamp-2">We need a skilled Backend Developer to build and maintain our server-side applications...</p>
                </div>
                <div class="text-right ml-6">
                    <div class="mb-2">
                        <span class="text-2xl font-bold text-gray-500">0</span>
                        <p class="text-sm text-gray-500">Applications</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 text-gray-400 hover:text-green-600 transition-colors rounded-lg hover:bg-green-50">
                            <i class="ri-send-plane-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-blue-600 transition-colors rounded-lg hover:bg-blue-50">
                            <i class="ri-edit-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-8 flex items-center justify-between">
    <div class="text-sm text-gray-700">
        Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">15</span> jobs
    </div>
    <div class="flex gap-2">
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-colors">Previous</button>
        <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg">1</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">2</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">3</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">Next</button>
    </div>
</div>
