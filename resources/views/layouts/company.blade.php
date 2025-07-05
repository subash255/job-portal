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

<div class="bg-gray-100 min-h-screen py-10 px-4">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Welcome Section -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }} 👋</h2>
            <p class="text-gray-600">Here's a summary of your activity.</p>
        </div>
        @yield('content')

         </div>
</div>

