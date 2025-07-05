<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Point</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-gray-100 to-white text-gray-800 font-sans">

    <!-- Navbar -->
    <header
        class="sticky top-0 z-50 bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 backdrop-blur shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-white">
                        Job<span class="text-orange-300">Point</span>
                    </h1>
                </div>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex space-x-4 items-center font-semibold">
                    <a href="{{ route('welcome') }}"
                        class="px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">Home</a>
                    <a href="{{ route('about') }}"
                        class="px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">About Us</a>
                    <a href="{{ route('job') }}"
                        class="px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">Jobs</a>
                    <a href="{{ route('contact') }}"
                        class="px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">Contact</a>
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm border-2 border-white text-white rounded-md hover:bg-white hover:text-indigo-600 transition-all duration-200">logout</a>
                    
                </nav>

                <!-- Mobile Hamburger -->
                <div class="md:hidden">
                    <button id="mobile-menu-button"
                        class="text-white focus:outline-none hover:text-yellow-300 transition-colors duration-200">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Nav Menu (overlay, hidden by default) -->
        <nav id="mobile-menu"
            class="absolute top-full left-0 right-0 z-50 bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 shadow-lg md:hidden hidden px-4 pb-4 space-y-2 transition-all duration-300 ease-in-out font-semibold">
            <a href="{{ route('welcome') }}"
                class="block px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">Home</a>
            <a href="{{ route('about') }}"
                class="block px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">About Us</a>
            <a href="{{ route('job') }}"
                class="block px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">Jobs</a>
            <a href="{{ route('contact') }}"
                class="block px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">Contact</a>
            <a href="{{ route('login') }}"
                class="block px-4 py-2 border-2 border-white text-white rounded-md hover:bg-white hover:text-indigo-600 text-sm transition-all duration-200">Login</a>
            <a href="{{ route('register') }}"
                class="block px-4 py-2 bg-yellow-400 text-indigo-800 rounded-md hover:bg-yellow-300 text-sm font-semibold transition-all duration-200">Register</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid gap-4 md:grid-cols-4">

            <!-- Logo + Description -->
            <div>
                <div class="flex items-center mb-4 space-x-2 font-semibold">
    <img src="/images/logoo.png" alt="JobPortal Logo" class="h-20 w-auto rounded-lg">
</div>

                <p class="text-sm text-gray-300 mb-4">
                    Your trusted platform for connecting top employers and talented job seekers worldwide.
                </p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 transition-colors duration-200">
                        <i class="ri-linkedin-box-fill text-xl"></i>
                    </a>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 transition-colors duration-200">
                        <i class="ri-youtube-fill text-xl"></i>
                    </a>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 transition-colors duration-200">
                        <i class="ri-twitter-fill text-xl"></i>
                    </a>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 transition-colors duration-200">
                        <i class="ri-instagram-fill text-xl"></i>
                    </a>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 transition-colors duration-200">
                        <i class="ri-facebook-box-fill text-xl"></i>
                    </a>
                </div>

            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-indigo-400 mb-4">Quick Links</h3>
                <ul class="space-y-2 text-gray-300 text-sm font-semibold">
                    <li><a href="{{ route('welcome') }}"
                            class="hover:text-indigo-300 transition-colors duration-200">Home</a></li>
                    <li><a href="{{ route('about') }}"
                            class="hover:text-indigo-300 transition-colors duration-200">About Us</a></li>
                    <li><a href="{{ route('job') }}"
                            class="hover:text-indigo-300 transition-colors duration-200">Jobs</a></li>

                    <li><a href="{{ route('contact') }}"
                            class="hover:text-indigo-300 transition-colors duration-200">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact Details -->
            <div>
                <h3 class="text-lg font-semibold text-indigo-400 mb-4">Contact Details</h3>
                <ul class="space-y-3 text-gray-300 text-sm font-semibold">
                    <li class="flex items-center space-x-2">
                        <i class="ri-map-pin-line text-indigo-400 text-lg"></i>
                        <span>Gaindakot-05, Nawalpur</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="ri-mail-line text-indigo-400 text-lg"></i>
                        <span>jobportal@gmail.com</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="ri-phone-line text-indigo-400 text-lg"></i>
                        <span>+977 9812211443</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="ri-time-line text-indigo-400 text-lg"></i>
                        <span>9 AM - 5 PM, Sun - Fri</span>
                    </li>
                </ul>
            </div>


            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-semibold text-indigo-400 mb-4">Newsletter</h3>
                <p class="text-sm text-gray-300 mb-4">
                    Subscribe to our newsletter for latest jobs and updates.
                </p>
                <form class="flex border border-gray-600 rounded-lg overflow-hidden">
                    <input type="email" placeholder="Enter your email"
                        class="flex-1 px-2 py-2 bg-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-400">
                    <button type="submit"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 hover:from-indigo-700 hover:to-purple-700 font-semibold transition-all duration-200">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-12 pt-6 text-center text-sm text-gray-400">
            &copy; 2025 <span class="text-indigo-400 font-semibold">JobPortal</span>. All Rights Reserved.
        </div>
    </footer>

    <script>
        // Vanilla JS to toggle mobile menu
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>


</html>
