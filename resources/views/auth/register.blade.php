@extends('layouts.master')
@section('content')
    <div
        class="bg-gradient-to-b from-purple-500 via-purple-300 to-purple-100 min-h-screen py-12 xl:px-16 lg:px-12 sm:px-8 px-4 flex items-center justify-center">
        <div class="xl:max-w-6xl w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <img class="w-full h-[40rem] hidden lg:block object-cover" src="images/signup.svg" alt="Register Image" />

                <!-- Toggle Titles -->
                <div class="bg-gray-100 py-12 px-8 sm:px-16 rounded-md w-full">
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="ri-error-warning-line text-red-500 text-lg mr-2"></i>
                                <h3 class="text-red-800 font-medium">Registration Failed</h3>
                            </div>
                            <ul class="mt-2 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center mt-1">
                                        <i class="ri-close-circle-line text-red-500 text-sm mr-2"></i>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex justify-center gap-4 mb-6 border-b border-gray-200">
                        <button id="userBtn"
                            class="tab-btn active border-b-4 border-blue-600 text-blue-600 font-semibold px-6 py-2 text-lg focus:outline-none transition-all duration-200">
                            For Job Seekers
                        </button>
                        <button id="companyBtn"
                            class="tab-btn border-b-4 border-transparent text-gray-600 font-semibold px-6 py-2 text-lg hover:text-blue-600 focus:outline-none transition-all duration-200">
                            For Employers
                        </button>
                    </div>

                    <!-- User Form (Job Seekers) -->
                    <form id="userForm" action="{{route('register.userstore')}}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700" id="uname">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}" />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700" id="uemail">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}" />
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700" id="unumber">Contact Number</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="e.g., +1234567890 or 123-456-7890"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }}" />
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div>
                            <label class="block text-gray-700">Password</label>
                            <div class="relative">
                                <input type="password" id="user-password" name="password"
                                    class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}" />
                                <button type="button" onclick="togglePassword('user-password', this)"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600">
                                    <i class="ri-eye-fill"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <label class="block text-gray-700">Confirm Password</label>
                            <div class="relative">
                                <input type="password" id="user-confirm-password" name="password_confirmation"
                                    class="w-full border px-4 py-2 rounded-lg focus:outline-one focus:ring-2 focus:ring-blue-500 pr-10 {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }}" />
                                <button type="button" onclick="togglePassword('user-confirm-password', this)"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600">
                                    <i class="ri-eye-fill"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <input type="hidden" name="role" value="user">

                        <!-- Terms and Conditions -->
                        <div class="flex items-start space-x-2">
                            <input type="checkbox" id="user-terms" class="mt-1">
                            <label for="user-terms" class="text-gray-700 text-sm">
                                I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and
                                    Conditions</a> and <a href="#" class="text-blue-600 hover:underline">Privacy
                                    Policy</a>.
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Register</button>
                    </form>

                    <!-- Company Form (Employers) -->
                    <form id="companyForm" action="{{route('register.companystore')}}" method="POST" class="space-y-4 hidden">
                        @csrf
                        <div>
                            <label class="block text-gray-700" id="cname">Company Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}" />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700" id="uemail">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}" />
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700" id="unumber">Contact Number</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="e.g., +1234567890 or 123-456-7890"
                                class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }}" />
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Password</label>
                            <div class="relative">
                                <input type="password" id="user-password" name="password"
                                    class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}" />
                                <button type="button" onclick="togglePassword('user-password', this)"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600">
                                    <i class="ri-eye-fill"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <label class="block text-gray-700">Confirm Password</label>
                            <div class="relative">
                                <input type="password" id="user-confirm-password" name="password_confirmation"
                                    class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10 {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }}" />
                                <button type="button" onclick="togglePassword('user-confirm-password', this)"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600">
                                    <i class="ri-eye-fill"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="ri-error-warning-line mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <input type="hidden" name="role" value="company">

                        <!-- Terms and Conditions -->
                        <div class="flex items-start space-x-2">
                            <input type="checkbox" id="company-terms" class="mt-1">
                            <label for="terms" class="text-gray-700 text-sm">
                                I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and
                                    Conditions</a> and <a href="#" class="text-blue-600 hover:underline">Privacy
                                    Policy</a>.
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Register</button>
                    </form>
                    <div class="flex items-center gap-x-4 mt-4">
                        <p class="border-b-2 w-full border-gray-300"></p>
                        <p class="text-quaternary text-base">OR</p>
                        <p class="border-b-2 w-full border-gray-300"></p>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="text-base">Already have an account? <a href="{{ route('login') }}"
                                class="hover:underline font-semibold text-blue-600">Login</a></p>
                    </div>
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
    @endsection
