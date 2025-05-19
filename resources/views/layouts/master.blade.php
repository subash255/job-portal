<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Portal</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

  <body class="bg-gradient-to-br from-gray-100 to-white text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-md">
      <div class="container mx-auto flex justify-between items-center p-4">
        <h1 class="text-xl font-bold text-blue-600">JobPortal</h1>
        <nav class="flex space-x-4">
          <a href="#" class="px-4 py-2 text-gray-700 hover:text-blue-600">Jobs</a>
          <a href="#" class="px-4 py-2 text-sm border rounded-md hover:bg-gray-100">Login</a>
          <a href="#" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">Register</a>
        </nav>
      </div>
    </header>
    <main>
        @yield('content')
    </main>
    

</body>

</html>
