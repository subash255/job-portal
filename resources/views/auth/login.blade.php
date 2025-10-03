@extends('layouts.master')
@section('content')
    <div
        class="bg-gradient-to-b from-purple-500 via-purple-300 to-purple-100 min-h-screen py-12 xl:px-16 lg:px-12 sm:px-8 px-4 flex items-center justify-center">
        <div class="xl:max-w-6xl w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <img class="w-full lg:block hidden" src="images/login.svg" alt="Login Image">
                <div class="bg-gray-100 py-12 px-8 sm:px-16 rounded-md w-full">
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold">
                            Welcome To Job Portal!
                        </h1>
                        <h2 class="mt-2 text-lg">
                            Login to your account
                        </h2>
                    </div>
                    <div class="mt-6">
                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <i class="ri-error-warning-line text-red-500 text-lg mr-2"></i>
                                    <h3 class="text-red-800 font-medium">Authentication Failed</h3>
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

                        <form action="{{route('login')}}" class="space-y-6" method="POST">
                            @csrf
                            <div>
                                <label for="email" class="text-base font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" placeholder="Enter email address"
                                    value="{{ old('email') }}"
                                    class="mt-2 w-full px-4 py-4 placeholder:text-sm border rounded-md shadow-sm focus:ring-0 sm:text-base {{ $errors->has('email') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-blue-500' }}"
                                    required="">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="ri-error-warning-line mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="text-base font-medium text-gray-700">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" placeholder="Enter password"
                                        value=""
                                        class="mt-2 w-full px-4 py-4 placeholder:text-sm border rounded-md shadow-sm focus:ring-0 sm:text-base {{ $errors->has('password') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-blue-500' }}"
                                        required="">
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="ri-error-warning-line mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-md focus:ring-2 focus:ring-blue-500">
                                    Login
                                </button>
                            </div>
                        </form>
                        <div class="flex items-center gap-x-4 mt-8">
                            <p class="border-b-2 w-full border-gray-300"></p>
                            <p class="text-quaternary text-base">OR</p>
                            <p class="border-b-2 w-full border-gray-300"></p>
                        </div>

                        <div class="mt-8 text-center">
                            <p class="text-base">Don't have an account? <a href="{{ route('register') }}"
                                    class="hover:underline font-semibold text-blue-500">Sign Up</a></p>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="{{ route('password.request') }}" class="hover:underline font-semibold text-blue-500">Forgot Your Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
