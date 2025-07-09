<!-- Dashboard Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-600 mt-1">Welcome back! Here's what's happening with your company.</p>
        </div>
        
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-2xl text-white shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="ri-briefcase-line text-xl"></i>
            </div>
            <span class="text-2xl font-bold">{{ $totalJobs }}</span>
        </div>
        <p class="text-blue-100 text-sm font-medium">Total Jobs</p>
    </div>

    <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-2xl text-white shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="ri-user-line text-xl"></i>
            </div>
            <span class="text-2xl font-bold">{{ $totalApplications }}</span>
        </div>
        <p class="text-green-100 text-sm font-medium">Total Applications</p>
    </div>

    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-2xl text-white shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="ri-pulse-line text-xl"></i>
            </div>
            <span class="text-2xl font-bold">{{ $activeJobs }}</span>
        </div>
        <p class="text-purple-100 text-sm font-medium">Active Jobs</p>
    </div>

    <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-6 rounded-2xl text-white shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="ri-calendar-line text-xl"></i>
            </div>
            <span class="text-2xl font-bold">{{ $closedJobs }}</span>
        </div>
        <p class="text-orange-100 text-sm font-medium">Closed Jobs</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
    <h3 class="text-xl font-bold text-gray-800 mb-6">Quick Actions</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('company.create') }}" class="flex items-center p-4 bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-200 rounded-xl hover:from-indigo-100 hover:to-purple-100 transition-all duration-200 group">
            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                <i class="ri-add-line text-white"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Post New Job</h4>
                <p class="text-sm text-gray-600">Create a new job posting</p>
            </div>
        </a>

        <a href="{{ route('company.applications') }}" class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-200 group">
            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                <i class="ri-user-line text-white"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">View Applications</h4>
                <p class="text-sm text-gray-600">Review applications</p>
            </div>
        </a>

        <a href="{{ route('company.profile') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-xl hover:from-blue-100 hover:to-cyan-100 transition-all duration-200 group">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                <i class="ri-building-line text-white"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Company Profile</h4>
                <p class="text-sm text-gray-600">Update company info</p>
            </div>
        </a>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
    <!-- Recent Jobs -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">Recent Jobs</h3>
            <a href="{{ route('company.jobs') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">View All</a>
        </div>
        
        <div class="space-y-4">
            @if($recentJobs->count() > 0)
                @foreach ($recentJobs as $work)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center mr-3">
                            <i class="ri-briefcase-line text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">{{$work->title}}</h4>
                            <p class="text-sm text-gray-600">{{ $work->applicants->count() }} applications</p>
                        </div>
                    </div>
                    @if($work->status == 'active')
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            Active
                        </span>
                    @elseif($work->status == 'closed')
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                            Closed
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                            Draft
                        </span>
                    @endif
                </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-4">
                        <i class="ri-briefcase-line text-4xl"></i>
                    </div>
                    <p class="text-gray-500 text-sm">No jobs posted yet</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">Recent Applications</h3>
            <a href="{{ route('company.applications') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">View All</a>
        </div>
        
        <div class="space-y-4">
            @if($recentApplications->count() > 0)
                @foreach ($recentApplications as $application)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                            {{ strtoupper(substr($application->applicant->name, 0, 1)) }}{{ strtoupper(substr($application->applicant->name, strpos($application->applicant->name, ' ') + 1, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">{{$application->applicant->name}}</h4>
                            <p class="text-sm text-gray-600">{{$application->work->title}}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                        New
                    </span>
                </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-4">
                        <i class="ri-user-line text-4xl"></i>
                    </div>
                    <p class="text-gray-500 text-sm">No applications yet</p>
                </div>
            @endif
        </div>
    </div>
</div>


