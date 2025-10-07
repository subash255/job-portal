@extends('layouts.master')
@section('content')
    <div class="bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-600 min-h-screen py-12 xl:px-16 lg:px-12 sm:px-8 px-4 flex items-center justify-center">
        <div class="xl:max-w-4xl w-full mx-auto">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Left Side - Illustration -->
                    <div class="bg-gradient-to-br from-purple-600 to-blue-600 p-12 hidden lg:flex items-center justify-center">
                        <div class="text-center text-white">
                            <div class="mb-8">
                                <svg class="w-32 h-32 mx-auto mb-6 text-white/80" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold mb-4">Check Your Email</h2>
                            <p class="text-lg text-white/90 leading-relaxed">
                                We've sent a verification link to your email address. 
                                Click the link to activate your account and start exploring job opportunities!
                            </p>
                        </div>
                    </div>

                    <!-- Right Side - Form -->
                    <div class="p-12 lg:p-16">
                        <div class="text-center mb-8">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 lg:hidden">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">Email Verification</h1>
                            <p class="text-gray-600">Almost there! Let's verify your email address</p>
                        </div>

                        <!-- Main Message -->
                        <div class="mb-8 p-6 bg-blue-50 border border-blue-200 rounded-xl">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Verification Required</h3>
                                    <p class="text-blue-700 text-sm leading-relaxed">
                                        Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you. If you didn't receive the email, we'll gladly send you another.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Success Message -->
                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-green-800">Email Sent!</h4>
                                        <p class="text-green-700 text-sm">A new verification link has been sent to your email address.</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="space-y-4">
                            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-semibold py-4 px-6 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <div class="flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        <span>Resend Verification Email</span>
                                    </div>
                                </button>
                            </form>

                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">or</span>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition duration-300 border border-gray-300">
                                    <div class="flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        <span>Log Out</span>
                                    </div>
                                </button>
                            </form>
                        </div>

                        <!-- Additional Help -->
                        <div class="mt-8 p-4 bg-gray-50 rounded-xl">
                            <h4 class="font-semibold text-gray-800 mb-2">Need Help?</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• Check your spam/junk folder</li>
                                <li>• Make sure the email address is correct</li>
                                <li>• Contact support if you continue having issues</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
