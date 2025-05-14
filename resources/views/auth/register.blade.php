<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Job Portal Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
  <div class="w-full max-w-3xl bg-white p-6 rounded-xl shadow-md">
    <!-- Toggle Titles -->
    <div class="flex justify-center mb-6">
      <button id="companyBtn" class="title-btn active border-b-4 border-blue-600 text-blue-600 font-semibold px-6 py-2 text-lg focus:outline-none">
        As a Company
      </button>
      <button id="userBtn" class="title-btn border-b-4 border-transparent text-gray-600 font-semibold px-6 py-2 text-lg hover:text-blue-600 focus:outline-none">
        As a User
      </button>
    </div>

    <!-- Company Form -->
    <form id="companyForm" class="space-y-4">
      <div>
        <label class="block text-gray-700">Company Name</label>
        <input type="text" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block text-gray-700">Email</label>
        <input type="email" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block text-gray-700">Password</label>
        <input type="password" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block text-gray-700">Company Website</label>
        <input type="url" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Register as Company</button>
    </form>

    <!-- User Form -->
    <form id="userForm" class="space-y-4 hidden">
      <div>
        <label class="block text-gray-700">Full Name</label>
        <input type="text" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block text-gray-700">Email</label>
        <input type="email" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block text-gray-700">Password</label>
        <input type="password" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block text-gray-700">Resume (URL)</label>
        <input type="url" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Register as User</button>
    </form>
  </div>

  <script>
    const companyBtn = document.getElementById('companyBtn');
    const userBtn = document.getElementById('userBtn');
    const companyForm = document.getElementById('companyForm');
    const userForm = document.getElementById('userForm');

    companyBtn.addEventListener('click', () => {
      companyForm.classList.remove('hidden');
      userForm.classList.add('hidden');
      companyBtn.classList.add('border-blue-600', 'text-blue-600');
      userBtn.classList.remove('border-blue-600', 'text-blue-600');
      companyBtn.classList.remove('text-gray-600');
      userBtn.classList.add('text-gray-600');
    });

    userBtn.addEventListener('click', () => {
      userForm.classList.remove('hidden');
      companyForm.classList.add('hidden');
      userBtn.classList.add('border-blue-600', 'text-blue-600');
      companyBtn.classList.remove('border-blue-600', 'text-blue-600');
      userBtn.classList.remove('text-gray-600');
      companyBtn.classList.add('text-gray-600');
    });
  </script>
</body>
</html>
