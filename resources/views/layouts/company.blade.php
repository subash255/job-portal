<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Company Dashboard - Job Point')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 backdrop-blur shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-white">
                        Job<span class="text-orange-300">Point</span>
                    </h1>
                </div>

                <!-- Empty space for center alignment -->
                <div class="flex-1"></div>

                <!-- User Menu -->
                <div class="relative">
                    <button id="userMenuButton" class="text-white font-semibold px-4 py-2 hover:text-yellow-400 transition-all duration-200 flex items-center space-x-2">
                        <div class="w-8 h-8 bg-white text-indigo-600 rounded-full flex items-center justify-center">
                            <span class="text-sm font-medium">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <i class="ri-arrow-down-s-line text-sm"></i>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                        <a href="{{route('company.profile')}}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="ri-user-line mr-2"></i>Profile
                        </a>
                        <a href="{{route('company.settings')}}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="ri-settings-3-line mr-2"></i>Settings
                        </a>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="ri-logout-box-line mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobileMenuButton" class="text-white hover:text-yellow-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 rounded-md p-2">
                        <i class="ri-menu-line text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="md:hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 border-t border-white border-opacity-20 hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('company.index') }}" class="block px-3 py-2 text-base font-medium text-white hover:text-yellow-300 hover:bg-white hover:bg-opacity-10 rounded-md">
                    <i class="ri-dashboard-line mr-2"></i>Dashboard
                </a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-white hover:text-yellow-300 hover:bg-white hover:bg-opacity-10 rounded-md">
                    <i class="ri-briefcase-line mr-2"></i>Jobs
                </a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-white hover:text-yellow-300 hover:bg-white hover:bg-opacity-10 rounded-md">
                    <i class="ri-user-line mr-2"></i>Applications
                </a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-white hover:text-yellow-300 hover:bg-white hover:bg-opacity-10 rounded-md">
                    <i class="ri-building-line mr-2"></i>Company Profile
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen bg-gradient-to-br from-gray-100 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Main Layout with Sidebar -->
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                        <!-- Company Profile Card -->
                        <div class="text-center mb-8">
                            <div class="relative inline-block">
                                <div class="w-20 h-20 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <i class="ri-building-line text-2xl text-white"></i>
                                </div>
                                <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 rounded-full ring-2 ring-white"></div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ auth()->user()->email }}</p>
                            <span class="inline-block bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded-full mt-2">Company Account</span>
                        </div>

                        <!-- Navigation Menu -->
                        <nav class="space-y-2">
                            <a href="{{ route('company.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 {{ request()->routeIs('company.index') ? 'bg-indigo-50 text-indigo-600 border-r-2 border-indigo-600' : '' }}">
                                <i class="ri-dashboard-line text-lg"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>

                            <a href="{{ route('company.jobs') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 {{ request()->routeIs('company.jobs*') ? 'bg-indigo-50 text-indigo-600 border-r-2 border-indigo-600' : '' }}">
                                <i class="ri-briefcase-line text-lg"></i>
                                <span class="font-medium">Jobs</span>
                            </a>

                            <a href="{{ route('company.applications') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 {{ request()->routeIs('company.applications') ? 'bg-indigo-50 text-indigo-600 border-r-2 border-indigo-600' : '' }}">
                                <i class="ri-user-line text-lg"></i>
                                <span class="font-medium">Applications</span>
                            </a>

                            <a href="{{ route('company.profile') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 {{ request()->routeIs('company.profile') ? 'bg-indigo-50 text-indigo-600 border-r-2 border-indigo-600' : '' }}">
                                <i class="ri-building-line text-lg"></i>
                                <span class="font-medium">Company Profile</span>
                            </a>

                            <a href="{{ route('company.settings') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 {{ request()->routeIs('company.settings') ? 'bg-indigo-50 text-indigo-600 border-r-2 border-indigo-600' : '' }}">
                                <i class="ri-settings-3-line text-lg"></i>
                                <span class="font-medium">Settings</span>
                            </a>

                            <div class="border-t pt-4 mt-6">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 px-4 py-3 text-red-600 rounded-lg hover:bg-red-50 transition-colors duration-200 w-full text-left">
                                        <i class="ri-logout-box-line text-lg"></i>
                                        <span class="font-medium">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </nav>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:w-3/4">
                    <div class="bg-white rounded-2xl shadow-lg p-6 min-h-[500px]">
                        <!-- Page Content -->
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <h1 class="text-2xl md:text-3xl font-bold text-center text-white">
                        Job<span class="text-orange-300">Point</span>
                    </h1>
                    </div>
                    <p class="text-gray-100 mb-4">
                        Connecting talented professionals with leading companies. Build your dream team with our comprehensive job portal platform.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">
                            <i class="ri-facebook-line text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">
                            <i class="ri-twitter-line text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">
                            <i class="ri-linkedin-line text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">
                            <i class="ri-instagram-line text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('company.index') }}" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">Dashboard</a></li>
                        <li><a href="{{ route('company.jobs') }}" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">My Jobs</a></li>
                        <li><a href="{{ route('company.applications') }}" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">Applications</a></li>
                        <li><a href="{{ route('company.profile') }}" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">Company Profile</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">Help Center</a></li>
                        <li><a href="#" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">Contact Us</a></li>
                        <li><a href="#" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-100 hover:text-yellow-300 transition-colors duration-200">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white border-opacity-20 mt-8 pt-8">
                <div class="flex flex-col md:flex-row justify-center items-center">
                    <p class="text-gray-100 text-sm">
                        &copy; {{ date('Y') }} Job Point. All rights reserved.
                    </p>
                   
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Toggle user dropdown
        document.getElementById('userMenuButton').addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        });

        // Toggle mobile menu
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        });



        // Auto-hide success messages
        setTimeout(function() {
            const successMessages = document.querySelectorAll('.alert, .notification, .success-message, .error-message');
            successMessages.forEach(function(message) {
                message.style.transition = 'opacity 0.5s ease-out';
                message.style.opacity = '0';
                setTimeout(function() {
                    message.remove();
                }, 500);
            });
        }, 5000);
    </script>
</body>

</html>

