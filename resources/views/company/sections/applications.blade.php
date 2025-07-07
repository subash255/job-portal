<!-- Applications Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Applications</h1>
            <p class="text-gray-600 mt-1">Review and manage candidate applications</p>
        </div>
        <div class="flex items-center space-x-4">
            <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="ri-filter-line mr-2"></i>Filter
            </button>
            
        </div>
    </div>
</div>


<!-- Filter and Search -->
<div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 mb-8">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex flex-col md:flex-row gap-4 flex-1">
            <div class="relative">
                <input type="text" placeholder="Search applicants..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option>All Jobs</option>
                <option>Senior Frontend Developer</option>
                <option>Digital Marketing Manager</option>
                <option>Backend Developer</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option>All Status</option>
                <option>New</option>
                <option>Under Review</option>
                <option>Shortlisted</option>
                <option>Interview</option>
                <option>Rejected</option>
            </select>
        </div>
    </div>
</div>

<!-- Applications List -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100">
    <div class="p-6 border-b border-gray-100">
        <h3 class="text-xl font-bold text-gray-800">Recent Applications</h3>
    </div>
    
    <div class="divide-y divide-gray-100">
        <!-- Application Item -->
        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                        JD
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">John Doe</h4>
                        <p class="text-sm text-gray-600">Applied for Senior Frontend Developer</p>
                        <div class="flex items-center gap-4 mt-1">
                            <span class="text-xs text-gray-500">2 hours ago</span>
                            <span class="text-xs text-gray-500">•</span>
                            <span class="text-xs text-gray-500">5 years experience</span>
                            <span class="text-xs text-gray-500">•</span>
                            <span class="text-xs text-gray-500">React, Node.js, TypeScript</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                        New
                    </span>
                    <div class="flex gap-2">
                        <button class="p-2 text-gray-400 hover:text-indigo-600 transition-colors rounded-lg hover:bg-indigo-50" title="View Profile">
                            <i class="ri-eye-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-green-600 transition-colors rounded-lg hover:bg-green-50" title="Shortlist">
                            <i class="ri-bookmark-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-purple-600 transition-colors rounded-lg hover:bg-purple-50" title="Schedule Interview">
                            <i class="ri-calendar-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" title="Reject">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Item -->
        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-green-700 rounded-full flex items-center justify-center text-white font-semibold">
                        SM
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Sarah Miller</h4>
                        <p class="text-sm text-gray-600">Applied for Digital Marketing Manager</p>
                        <div class="flex items-center gap-4 mt-1">
                            <span class="text-xs text-gray-500">1 day ago</span>
                            <span class="text-xs text-gray-500">•</span>
                            <span class="text-xs text-gray-500">3 years experience</span>
                            <span class="text-xs text-gray-500">•</span>
                            <span class="text-xs text-gray-500">SEO, Social Media, Analytics</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                        Under Review
                    </span>
                    <div class="flex gap-2">
                        <button class="p-2 text-gray-400 hover:text-indigo-600 transition-colors rounded-lg hover:bg-indigo-50" title="View Profile">
                            <i class="ri-eye-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-green-600 transition-colors rounded-lg hover:bg-green-50" title="Shortlist">
                            <i class="ri-bookmark-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-purple-600 transition-colors rounded-lg hover:bg-purple-50" title="Schedule Interview">
                            <i class="ri-calendar-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" title="Reject">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Item -->
        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center text-white font-semibold">
                        MJ
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Michael Johnson</h4>
                        <p class="text-sm text-gray-600">Applied for Senior Frontend Developer</p>
                        <div class="flex items-center gap-4 mt-1">
                            <span class="text-xs text-gray-500">3 days ago</span>
                            <span class="text-xs text-gray-500">•</span>
                            <span class="text-xs text-gray-500">7 years experience</span>
                            <span class="text-xs text-gray-500">•</span>
                            <span class="text-xs text-gray-500">Vue.js, Laravel, MySQL</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                        Shortlisted
                    </span>
                    <div class="flex gap-2">
                        <button class="p-2 text-gray-400 hover:text-indigo-600 transition-colors rounded-lg hover:bg-indigo-50" title="View Profile">
                            <i class="ri-eye-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-green-600 transition-colors rounded-lg hover:bg-green-50" title="Shortlist">
                            <i class="ri-bookmark-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-purple-600 transition-colors rounded-lg hover:bg-purple-50" title="Schedule Interview">
                            <i class="ri-calendar-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" title="Reject">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Item -->
        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-600 to-red-600 rounded-full flex items-center justify-center text-white font-semibold">
                        EW
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Emma Wilson</h4>
                        <p class="text-sm text-gray-600">Applied for Digital Marketing Manager</p>
                        <div class="flex items-center gap-4 mt-1">
                            <span class="text-xs text-gray-500">1 week ago</span>
                            <span class="text-xs text-gray-500">•</span>
                            <span class="text-xs text-gray-500">4 years experience</span>
                            <span class="text-xs text-gray-500">•</span>
                            <span class="text-xs text-gray-500">Content Marketing, PPC, Email</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                        Interview Scheduled
                    </span>
                    <div class="flex gap-2">
                        <button class="p-2 text-gray-400 hover:text-indigo-600 transition-colors rounded-lg hover:bg-indigo-50" title="View Profile">
                            <i class="ri-eye-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-green-600 transition-colors rounded-lg hover:bg-green-50" title="Shortlist">
                            <i class="ri-bookmark-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-purple-600 transition-colors rounded-lg hover:bg-purple-50" title="Schedule Interview">
                            <i class="ri-calendar-line"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" title="Reject">
                            <i class="ri-close-line"></i>
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
        Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">128</span> applications
    </div>
    <div class="flex gap-2">
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-colors">Previous</button>
        <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg">1</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">2</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">3</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">Next</button>
    </div>
</div>
