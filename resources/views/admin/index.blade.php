@extends('layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Stats Cards Section -->
    <div class="relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-3 mx-4 z-20 rounded-lg">
        <!-- Total Jobs Card -->
        <div class="bg-white p-6 text-left hover:shadow-2xl flex flex-row items-center justify-between w-full h-20 rounded-lg transform sm:-translate-y-8 lg:-translate-y-12 shadow-lg z-[5]">
            <div>
                <h2 class="text-gray-700 font-medium">Total Jobs</h2>
                <p class="text-gray-700 font-medium">{{ $totalJobs }}</p>
            </div>
            <div class="bg-blue-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-briefcase-line text-2xl"></i>
            </div>
        </div>

        <!-- Total Applications Card -->
        <div class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform sm:-translate-y-8 lg:-translate-y-12 shadow-lg">
            <div>
                <h2 class="text-gray-700 font-medium mb-2">Total Applications</h2>
                <p class="text-gray-700 font-medium">{{ $totalApplications }}</p>
            </div>
            <div class="bg-green-600 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-file-text-line text-2xl"></i>
            </div>
        </div>

        <!-- Total Employers Card -->
        <div class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform sm:-translate-y-8 lg:-translate-y-12 shadow-lg">
            <div>
                <h2 class="text-gray-700 font-medium mb-2">Total Employers</h2>
                <p class="text-gray-700 font-medium">{{ $totalEmployers }}</p>
            </div>
            <div class="bg-purple-600 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-building-line text-2xl"></i>
            </div>
        </div>

        <!-- Total Job Seekers Card -->
        <div class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform sm:-translate-y-8 lg:-translate-y-12 shadow-lg">
            <div>
                <h2 class="text-gray-700 font-medium mb-2">Job Seekers</h2>
                <p class="text-gray-700 font-medium">{{ $totalJobSeekers }}</p>
            </div>
            <div class="bg-orange-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-user-line text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="mt-2 mx-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top Categories Pie Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">Top Job Categories</h3>
                <div class="flex justify-center" style="height: 400px;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            <!-- Weekly Growth -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Weekly Growth</h3>
                <div class="space-y-4">
                    @php
                        $weeklyJobs = \App\Models\Work::where('created_at', '>=', now()->subWeek())->count();
                        $weeklyApplications = \App\Models\Applicant::where('created_at', '>=', now()->subWeek())->count();
                        $weeklyEmployers = \App\Models\User::where('role', 'company')->where('created_at', '>=', now()->subWeek())->count();
                    @endphp
                    
                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                <i class="ri-briefcase-line text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">New Jobs</span>
                        </div>
                        <span class="text-xl font-bold text-blue-600">+{{ $weeklyJobs }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                <i class="ri-file-text-line text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Applications</span>
                        </div>
                        <span class="text-xl font-bold text-green-600">+{{ $weeklyApplications }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                <i class="ri-building-line text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Employers</span>
                        </div>
                        <span class="text-xl font-bold text-purple-600">+{{ $weeklyEmployers }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Category Pie Chart
        @php
            $allCategories = \App\Models\Category::withCount(['works' => function($query) {
                $query->where('status', 'active');
            }])->having('works_count', '>', 0)->orderBy('works_count', 'desc')->get();
            
            $categoryLabels = $allCategories->pluck('name')->toArray();
            $categoryData = $allCategories->pluck('works_count')->toArray();
        @endphp

        var ctx = document.getElementById('categoryChart').getContext('2d');
        var categoryChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($categoryLabels) !!},
                datasets: [{
                    label: 'Jobs by Category',
                    data: {!! json_encode($categoryData) !!},
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',   // Blue
                        'rgba(16, 185, 129, 0.8)',   // Green
                        'rgba(139, 69, 199, 0.8)',   // Purple
                        'rgba(245, 158, 11, 0.8)',   // Orange
                        'rgba(239, 68, 68, 0.8)',    // Red
                        'rgba(236, 72, 153, 0.8)',   // Pink
                        'rgba(14, 165, 233, 0.8)',   // Light Blue
                        'rgba(168, 85, 247, 0.8)',   // Violet
                        'rgba(34, 197, 94, 0.8)',    // Emerald
                        'rgba(251, 146, 60, 0.8)',   // Amber
                        'rgba(99, 102, 241, 0.8)',   // Indigo
                        'rgba(244, 63, 94, 0.8)',    // Rose
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(139, 69, 199, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(236, 72, 153, 1)',
                        'rgba(14, 165, 233, 1)',
                        'rgba(168, 85, 247, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(251, 146, 60, 1)',
                        'rgba(99, 102, 241, 1)',
                        'rgba(244, 63, 94, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 10,
                            usePointStyle: true,
                            font: {
                                size: 10
                            },
                            boxWidth: 10,
                            boxHeight: 10,
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map((label, i) => {
                                        const value = data.datasets[0].data[i];
                                        const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                        const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                        return {
                                            text: `${label} (${percentage}%)`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            hidden: false,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            size: 14,
                            weight: 'bold',
                        },
                        bodyFont: {
                            size: 12
                        },
                        callbacks: {
                            label: function(tooltipItem) {
                                var total = tooltipItem.dataset.data.reduce(function(a, b) {
                                    return a + b;
                                }, 0);
                                var percentage = Math.round((tooltipItem.raw / total) * 100);
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' jobs (' + percentage + '%)';
                            }
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                }
            }
        });
    </script>

@endsection