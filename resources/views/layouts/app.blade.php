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

    <style>
        /* Adjust the padding and positioning of the entries select box to avoid overlap */
        .dataTables_length select {
            padding-right: 35px;
            /* Add space for the dropdown arrow */
            appearance: none;
            /* Remove default dropdown appearance */
            -webkit-appearance: none;
            /* Remove default dropdown for Safari */
            -moz-appearance: none;
            /* Remove default dropdown for Firefox */
            width: auto;
            /* Auto adjust width to fit content */
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6"><path d="M0 0l5 5 5-5z" fill="none" stroke="#333" stroke-width="1"/></svg>') no-repeat right 10px center;
            background-size: 10px;
            /* Resize the custom arrow */
            text-indent: 0.01px;
            /* Adjust text indent for better alignment */
        }

        /* Optional: Add a border color when the select box is focused */
        .dataTables_length select:focus {
            border-color: #4A90E2;
            outline: none;
        }

        /* Optional: Remove dropdown arrow for a cleaner UI in specific cases */
        .dataTables_length select::-ms-expand {
            display: none;
            /* Remove the arrow in Internet Explorer */
        }
    </style>
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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>


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
                    class="sidebar-link flex items-center px-6 py-4 {{ request()->routeIs('admin.index') ? 'bg-red-600 text-white' : 'hover:bg-red-500 hover:text-white' }} transition-colors duration-200">
                    <i class="ri-layout-masonry-fill"></i>
                    <span class="ml-4 font-semibold">Dashboard</span>
                </a>
                <a href="#"
                    class="sidebar-link flex items-center px-6 py-4 {{ request()->routeIs('admin.jobs.index', 'admin.category.edit') ? 'bg-red-600 text-white' : 'hover:bg-red-500 hover:text-white' }} transition-colors duration-200">
                    <i class="ri-grid-line"></i>
                    <span class="ml-4 font-semibold">Jobs</span>
                </a>
                <a href="#"
                    class="sidebar-link flex items-center px-6 py-4 {{ request()->routeIs('admin.users.index', 'admin.fooditems.edit') ? 'bg-red-600 text-white' : 'hover:bg-red-500 hover:text-white' }} transition-colors duration-200">
                    <i class="ri-cup-fill"></i>
                    <span class="ml-4 font-semibold">Users</span>
                </a>
               

            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 w-full">
            <!-- Header Section -->
            <div class="w-full bg-red-600 text-white flex items-center justify-between px-4 py-14 shadow-lg">
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
                            <a href="{{ route('profile.edit') }}"
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