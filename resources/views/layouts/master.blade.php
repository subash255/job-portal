<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
     <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;300;400;600;700&display=swap" rel="stylesheet">
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
                    <h1 class="text-xl font-bold text-white">JobPortal</h1>
                </div>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex space-x-4 items-center font-semibold">
                    <a href="{{ route('welcome') }}"
                        class="px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">Home</a>
                    <a href="{{ route('about') }}"
                        class="px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">About Us</a>
                    <a href="#"
                        class="px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">Jobs</a>
                    <a href="{{ route('contact') }}"
                        class="px-4 py-2 text-white hover:text-yellow-300 transition-colors duration-200">Contact</a>
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm border-2 border-white text-white rounded-md hover:bg-white hover:text-indigo-600 transition-all duration-200">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 text-sm bg-yellow-400 text-indigo-800 rounded-md hover:bg-yellow-300 font-semibold transition-all duration-200">Register</a>
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
            <a href="#"
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
                    <!-- Replace with your logo if needed -->
                    <svg class="h-8 w-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v.5M8 6V4m0 2v.5m0 0V21l4-3 4 3V6.5" />
                    </svg>
                    <h2 class="text-2xl font-bold text-indigo-400">JobPortal</h2>
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
                    <li><a href="#" class="hover:text-indigo-300 transition-colors duration-200">Jobs</a></li>
                    
                    <li><a href="{{ route('contact') }}"
                            class="hover:text-indigo-300 transition-colors duration-200">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact Details -->
            <div>
                <h3 class="text-lg font-semibold text-indigo-400 mb-4">Contact Details</h3>
                <ul class="space-y-3 text-gray-300 text-sm font-semibold">
                    <li class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Gaindakot-05,Nawalpur</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>jobportal@gmail.com</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>+977 9812211443</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
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
