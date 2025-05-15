<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <div class="min-h-screen py-12 xl:px-16 lg:px-12 sm:px-8 px-4 flex items-center justify-center">
        <div class="xl:max-w-6xl w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <img class="w-full h-[40rem] lg:h-full lg:w-full hidden lg:block object-cover lg:object-cover rounded-lg"
                    src="images/signup.svg" alt="Register Image" />

                <!-- Toggle Titles -->
                <div class="bg-gray-100 py-12 px-8 sm:px-16 rounded-md w-full lg:col-span-2">
                    <div class="flex justify-center gap-4 mb-6 border-b border-gray-200">
                        <button id="companyBtn"
                            class="tab-btn active border-b-4 border-blue-600 text-blue-600 font-semibold px-6 py-2 text-lg focus:outline-none transition-all duration-200">
                            For Employers
                        </button>
                        <button id="userBtn"
                            class="tab-btn border-b-4 border-transparent text-gray-600 font-semibold px-6 py-2 text-lg hover:text-blue-600 focus:outline-none transition-all duration-200">
                            For Job Seekers
                        </button>
                    </div>

                    <!-- Company Form -->
                    <form id="companyForm" class="space-y-4">
                        <div>
                            <label class="block text-gray-700">Company Name</label>
                            <input type="text"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <div>
                            <label class="block text-gray-700">Email Address</label>
                            <input type="email"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <div>
                            <label class="block text-gray-700">Contact Number</label>
                            <input type="text"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <!-- Password -->
<div>
    <label class="block text-gray-700">Password</label>
    <div class="relative">
        <input type="password" id="password"
            class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10" />
        <button type="button" onclick="togglePassword('password', this)"
            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600">
            <i class="ri-eye-fill"></i>
        </button>
    </div>
</div>

<!-- Confirm Password -->
<div class="mt-4">
    <label class="block text-gray-700">Confirm Password</label>
    <div class="relative">
        <input type="password" id="confirm-password"
            class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10" />
        <button type="button" onclick="togglePassword('confirm-password', this)"
            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600">
            <i class="ri-eye-fill"></i>
        </button>
    </div>
</div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Register</button>
                    </form>

                    <!-- User Form -->
                    <form id="userForm" class="space-y-4 hidden">
                        <div>
                            <label class="block text-gray-700">Full Name</label>
                            <input type="text"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <div>
                            <label class="block text-gray-700">Email Address</label>
                            <input type="email"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <div>
                            <label class="block text-gray-700">Contact Number</label>
                            <input type="text"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
    <div>
        <label class="block text-gray-700">Password</label>
        <div class="relative">
            <input type="password" id="user-password"
                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10" />
            <button type="button" onclick="togglePassword('user-password', this)"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600">
                <i class="ri-eye-fill"></i>
            </button>
        </div>
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label class="block text-gray-700">Confirm Password</label>
        <div class="relative">
            <input type="password" id="user-confirm-password"
                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10" />
            <button type="button" onclick="togglePassword('user-confirm-password', this)"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600">
                <i class="ri-eye-fill"></i>
            </button>
        </div>
    </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Register</button>
                    </form>
                </div>
            </div>
        </div>



        <script>
            const companyBtn = document.getElementById('companyBtn');
            const userBtn = document.getElementById('userBtn');
            const companyForm = document.getElementById('companyForm');
            const userForm = document.getElementById('userForm');

            function activateTab(activeBtn, inactiveBtn, showForm, hideForm) {
                activeBtn.classList.add('border-blue-600', 'text-blue-600');
                activeBtn.classList.remove('border-transparent', 'text-gray-600');

                inactiveBtn.classList.remove('border-blue-600', 'text-blue-600');
                inactiveBtn.classList.add('border-transparent', 'text-gray-600');

                showForm.classList.remove('hidden');
                hideForm.classList.add('hidden');
            }

            companyBtn.addEventListener('click', () => {
                activateTab(companyBtn, userBtn, companyForm, userForm);
            });

            userBtn.addEventListener('click', () => {
                activateTab(userBtn, companyBtn, userForm, companyForm);
            });

 function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('ri-eye-fill');
            icon.classList.add('ri-eye-off-fill');
        } else {
            input.type = 'password';
            icon.classList.remove('ri-eye-off-fill');
            icon.classList.add('ri-eye-fill');
        }
    }
        </script>
</body>

</html>
