@extends('layouts.master')
@section('content')

    <div class="flex h-screen flex-col md:flex-row">
        <!-- Left Section (Image and Social Links) -->
        <div class="flex-1 md:flex hidden flex-col justify-between bg-gray-100 p-6">
            <div class="text-center mt-6">
                <img src="images/login.svg" alt="signin Image"
                    class="w-full object-cover mx-auto h-auto rounded-lg shadow-none">
            </div>
        </div>

        <!--Login Form -->
        <div class="flex-1 text-black p-8 flex flex-col justify-center items-center bg-gray-200">
            <h2 class="text-3xl font-bold mb-4">Login</h2>
            <small class="text-black text-2xl">Welcome to Job Finder</small>

            <!-- Display Error Messages -->
            @if ($errors->any())
                <div class="w-full bg-blue-100 text-blue-600 p-4 mb-4 rounded-lg shadow-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="w-full max-w-md mt-8 space-y-6">
                @csrf
                <!-- Email -->
                <input id="email" type="email" name="email" value="{{ old('email') }}" requiblue
                    autocomplete="email" placeholder="Email"
                    class="w-full p-4 rounded-lg bg-white text-black focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 shadow-md">

                <!-- Password -->
                <input id="password" type="password" name="password" requiblue autocomplete="current-password"
                    placeholder="Password"
                    class="w-full p-4 rounded-lg bg-white text-black focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 shadow-md">

                <!-- Forgot Password -->
                <div class="flex justify-end mt-2">
                    <a href="#" class="text-blue-600 text-sm font-medium hover:underline">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-md focus:ring-2 focus:ring-blue-500">
                    Login
                </button>
            </form>

            <div class="flex items-center my-4 w-full">
                <hr class="w-full border-t-2 border-gray-300">
                <span class="px-4 text-gray-700">OR</span>
                <hr class="w-full border-t-2 border-gray-300">
            </div>

            <!-- Sign Up Text -->
            <div class="mt-4 text-sm text-black">
                <p>Don't have an account? <a href="{{ route('register') }}"
                        class="text-blue-600 hover:underline font-bold">Sign Up</a>
                </p>
            </div>
        </div>
    </div>

@endsection
