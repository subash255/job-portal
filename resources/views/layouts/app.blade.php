<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Raleway:wght@100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

   
    <script>
        // Remove the JavaScript related to toggling the sidebar
        window.onload = function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content-container');

            // Make sure the sidebar is always in expanded state
        };
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        // Function to update entries based on user selection
        function updateEntries() {
            const entries = document.getElementById('entries').value; // Get selected value
            const url = new URL(window.location.href);
            url.searchParams.set('entries', entries);
            window.location.href = url;
        }
    </script>

</head>

<body class="bg-gray-100 text-gray-900 h-screen flex flex-col font-[Jost]">

    <div class="flex h-full">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-white text-gray-900 shadow-lg flex flex-col fixed top-0 bottom-0 left-0 transition-all duration-300 overflow-y-auto z-10">
            <div class="p-4 flex items-center justify-center bg-white">
                <div class="w-40 h-40 rounded-full border-2 border-gray-500 object-contain text-3xl font-bold">
            <span class="flex flex-col items-center justify-center h-full">Job<br> <span class="text-blue-600">Point</span></span>
        </div>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.index') }}"
                    class="sidebar-link flex items-center px-6 py-4 {{ request()->routeIs('admin.index') ? 'bg-indigo-600 text-white' : 'hover:bg-indigo-500 hover:text-white' }} transition-colors duration-200">
                    <i class="ri-layout-masonry-fill"></i>
                    <span class="ml-4 font-semibold">Dashboard</span>
                </a>
                <a href="{{ route('admin.jobs.index') }}"
                    class="sidebar-link flex items-center px-6 py-4 {{ request()->routeIs('admin.jobs.index', 'admin.category.edit') ? 'bg-indigo-600 text-white' : 'hover:bg-indigo-500 hover:text-white' }} transition-colors duration-200">
                    <i class="ri-suitcase-fill"></i>
                    <span class="ml-4 font-semibold">Jobs</span>
                </a>
                <a href="{{ route('admin.employers.index') }}"
                    class="sidebar-link flex items-center px-6 py-4 {{ request()->routeIs('admin.employers.index', 'admin.fooditems.edit') ? 'bg-indigo-600 text-white' : 'hover:bg-indigo-500 hover:text-white' }} transition-colors duration-200">
                    <i class="ri-building-fill"></i>
                    <span class="ml-4 font-semibold">Employers</span>
                </a>
                <a href="{{ route('admin.jobseeker.index') }}"
                    class="sidebar-link flex items-center px-6 py-4 {{ request()->routeIs('admin.jobseekers.index', 'admin.fooditems.edit') ? 'bg-indigo-600 text-white' : 'hover:bg-indigo-500 hover:text-white' }} transition-colors duration-200">
                    <i class="ri-user-fill"></i>
                    <span class="ml-4 font-semibold">Job Seekers</span>
                </a>
               
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 w-full">
            <!-- Header Section -->
            <div class="w-full bg-indigo-600 text-white flex items-center justify-between px-4 py-14 shadow-lg">
                <h1 class="text-xl font-semibold">{{ $title ?? 'Default Title' }}</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <div
                            class="flex items-center text-lg font-medium hover:text-white focus:outline-none cursor-pointer">
                            <!-- Display the logged-in user's name -->
                            <span>{{ Auth::user()->name }}</span>
                            <i class="ri-arrow-down-s-line text-white"></i>
                        </div>

                        <!-- Dropdown Menu -->
                        <div
                            class="absolute right-0 w-40 bg-white text-gray-800 rounded-md shadow-lg hidden group-hover:block z-[50]">
                            <a href="#"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="pb-6">
                @yield('content')
            </div>
        </main>


    </div>

</body>

</html>