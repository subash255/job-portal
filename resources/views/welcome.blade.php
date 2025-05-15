<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Portal</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-blue-600 text-white">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center p-6">
            <!-- Logo / Title -->
            <h1 class="text-3xl font-bold mb-4 md:mb-0">Job Portal</h1>

            <!-- Navigation Links -->
            <nav class="flex space-x-4 text-white font-medium mb-4 md:mb-0">
                <a href="/" class="hover:underline">Home</a>
                <a href="#about" class="hover:underline">About</a>
                <a href="#jobs" class="hover:underline">Jobs</a>
                <a href="{{ 'login' }}" class="hover:underline">Login</a>
                <a href="{{ 'register' }}" class="hover:underline">Register</a>
            </nav>

            <!-- Search Input -->
            <div class="w-full md:w-auto">
                <input type="text" placeholder="Search for jobs..."
                    class="w-full md:w-64 px-4 py-2 rounded-md text-black" />
            </div>
        </div>
    </header>


    <!-- Job Listings -->
    <main class="container mx-auto mt-8 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Job Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold">Frontend Developer</h2>
                <p class="text-gray-600">TechCorp · Remote</p>
                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Apply Now
                </button>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold">Backend Developer</h2>
                <p class="text-gray-600">CodeBase · New York</p>
                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Apply Now
                </button>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold">Full Stack Developer</h2>
                <p class="text-gray-600">DevWorks · San Francisco</p>
                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Apply Now
                </button>
            </div>

        </div>
    </main>

</body>

</html>
