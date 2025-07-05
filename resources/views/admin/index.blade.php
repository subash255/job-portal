@extends('layouts.app')
@section('content')
    <style>
        #myChart {
            width: 100% !important;
            max-width: 100%;
            height: 400px;
            max-height: 500px;
            margin: 0 auto;
        }

        #orderLineChart {
            height: 285px !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Cards Section -->
    <div class="relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-3 mx-4 z-20 rounded-lg">
        <!-- Pending Orders Card -->
        <div
            class="bg-white p-6 text-left hover:shadow-2xl flex flex-row items-center justify-between w-full h-20 rounded-lg transform sm:-translate-y-8 lg:-translate-y-12 shadow-lg z-[5]">
            <div>
                <h2 class="text-gray-700 font-medium">Total Jobs</h2>
                <p class="text-gray-700 font-medium">0</p>
            </div>
            <div class="bg-yellow-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-time-line text-2xl"></i>
            </div>
        </div>

        <!-- Reservation Card -->
        <div
            class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform sm:-translate-y-8 lg:-translate-y-12 shadow-lg">
            <div>
                <h2 class="text-gray-700 font-medium mb-2">Total Users</h2>
                <p class="text-gray-700 font-medium">10</p>
            </div>
            <div class="bg-yellow-600 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-calendar-check-fill text-2xl"></i>
            </div>
        </div>

        <!-- Sales Card -->
        <div
            class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform sm:-translate-y-8 lg:-translate-y-12 shadow-lg">
            <div>
                <h2 class="text-gray-700 font-medium mb-2">Total Sales</h2>
                <p class="text-gray-700 font-medium">€100</p>
            </div>
            <div class="bg-purple-600 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-money-dollar-circle-fill text-2xl"></i>
            </div>
        </div>



        <!-- Visitors Card -->
        <div
            class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform sm:-translate-y-4 lg:-translate-y-8 shadow-lg">
            <div>
                <h2 class="text-gray-700 font-medium mb-2">Visitors</h2>
                <p class="text-gray-700 font-medium">12</p>
            </div>
            <div class="bg-red-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-earth-fill text-2xl"></i>
            </div>
        </div>
    </div>

    {{-- <div class="grid sm:grid-cols-3 gap-4 px-4">
        <!-- Order Line Chart -->
        <div class="bg-white rounded-lg p-6 w-full col-span-2">
            <h2 class="text-xl font-semibold text-center mb-4">Total Visits</h2>
            <canvas id="orderLineChart"></canvas>
        </div>

        <!-- Category Pie Chart -->
        <div class="bg-white rounded-lg p-6 w-full">
            <h2 class="text-xl font-semibold text-center">Total Categories</h2>
            <canvas id="categoryChart"></canvas>
        </div>
    </div> --}}
    

    {{-- <script>
        // Category Pie Chart
        var ctx1 = document.getElementById('categoryChart').getContext('2d');
        var categoryChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($categoryLabels); ?>, // Categories
                datasets: [{
                    label: 'Products by Category',
                    data: <?php echo json_encode($categoryData); ?>, // Product counts
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)', // Darker background
                        titleFont: {
                            size: 16,
                            weight: 'bold',
                        },
                        bodyFont: {
                            size: 14
                        },
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' products';
                            }
                        },
                        displayColors: false, // Hide color boxes in tooltips
                    }
                }
            }
        });

    </script> --}}
@endsection