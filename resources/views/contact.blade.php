@extends('layouts.master')
@section('content')

<!-- Hero Section -->
<section style="background-image: url('/images/contact.jpg')" class="bg-cover bg-center bg-no-repeat text-white py-16">
   
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
            <p class="text-xl md:text-2xl text-indigo-100 max-w-3xl mx-auto">
                We're here to help you find your dream job or hire the perfect candidate.
            </p>
        </div>
   
</section>


<!-- Contact Information & Form Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Contact Information -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">Get in Touch</h2>

    <div class="space-y-6">
        <!-- Office Address -->
        <div class="flex items-start space-x-4">
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="ri-map-pin-line text-indigo-600 text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Office Address</h3>
                <p class="text-gray-600">Gaindakot-05<br>Nawalpur, Nepal</p>
            </div>
        </div>

        <!-- Phone -->
        <div class="flex items-start space-x-4">
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="ri-phone-line text-indigo-600 text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Phone Numbers</h3>
                <p class="text-gray-600">+977 1234 567 890<br>+977 9876 543 210</p>
            </div>
        </div>

        <!-- Email -->
        <div class="flex items-start space-x-4">
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="ri-mail-line text-indigo-600 text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Email Addresses</h3>
                <p class="text-gray-600">info@jobportal.com<br>support@jobportal.com</p>
            </div>
        </div>

        <!-- Working Hours -->
        <div class="flex items-start space-x-4">
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="ri-time-line text-indigo-600 text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Working Hours</h3>
                <p class="text-gray-600">Sunday - Friday: 9:00 AM - 6:00 PM<br>Saturday: Closed</p>
            </div>
        </div>
    </div>

    <!-- Social Media Links -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Follow Us</h3>
        <div class="flex space-x-4">
            <a href="#" class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white hover:bg-indigo-700 transition-colors duration-200">
                <i class="ri-twitter-fill text-xl"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white hover:bg-indigo-700 transition-colors duration-200">
                <i class="ri-facebook-fill text-xl"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white hover:bg-indigo-700 transition-colors duration-200">
                <i class="ri-linkedin-fill text-xl"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white hover:bg-indigo-700 transition-colors duration-200">
                <i class="ri-github-fill text-xl"></i>
            </a>
        </div>
    </div>
</div>


            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Send us a Message</h2>
                
                <form class="space-y-6">
                    <!-- Name Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first-name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" id="first-name" name="first_name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        </div>
                        <div>
                            <label for="last-name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" id="last-name" name="last_name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        </div>
                    </div>

                    <!-- Email and Phone -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        </div>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <select id="subject" name="subject" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <option value="">Select a subject</option>
                            <option value="job-seeker">Job Seeker Support</option>
                            <option value="employer">Employer Services</option>
                            <option value="technical">Technical Support</option>
                            <option value="partnership">Partnership Inquiry</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="6" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200" placeholder="Tell us how we can help you..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



@endsection