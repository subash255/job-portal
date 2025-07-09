@extends('layouts.master')
@section('content')


<!-- Who Are We Sections -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Contents -->
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Who Are We?</h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    JobPoint is Nepal's leading online job platform, dedicated to bridging the gap between talented job seekers and forward-thinking employers. Founded in 2020, we have grown to become the most trusted name in recruitment services across Nepal.
                </p>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Our mission is to revolutionize the job search experience by providing an intuitive, efficient, and comprehensive platform that serves both job seekers and employers with equal dedication. We believe that everyone deserves the opportunity to find meaningful work that aligns with their skills, passion, and career goals.
                </p>
                <div class="grid grid-cols-2 gap-6 mt-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-2">51,000+</div>
                        <div class="text-gray-600">Active Job Seekers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-2">2,300+</div>
                        <div class="text-gray-600">Trusted Employers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-2">10,000+</div>
                        <div class="text-gray-600">Jobs Posted</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-2">97%</div>
                        <div class="text-gray-600">Success Rate</div>
                    </div>
                </div>
            </div>
            
            <!-- Image -->
            <div class="relative">
                <div class="relative z-10">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                         alt="Team working together" 
                         class="w-full h-96 object-cover rounded-2xl shadow-2xl">
                </div>
                <div class="absolute -top-4 -right-4 w-full h-96 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl opacity-20"></div>
            </div>
        </div>
    </div>
</section>

<!-- What We Do Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Image -->
            <div class="relative lg:order-first">
                <div class="relative z-10">
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                         alt="Professional workspace" 
                         class="w-full h-96 object-cover rounded-2xl shadow-2xl">
                </div>
                <div class="absolute -top-4 -left-4 w-full h-96 bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl opacity-20"></div>
            </div>
            
            <!-- Content -->
            <div class="lg:order-last">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">What We Do?</h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    We provide a comprehensive suite of services designed to streamline the recruitment process for both job seekers and employers. Our platform leverages cutting-edge technology to deliver personalized job recommendations and efficient hiring solutions.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v.5M8 6V4m0 2v.5m0 0V21l4-3 4 3V6.5"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Job Matching</h3>
                            <p class="text-gray-600">Advanced AI-powered algorithms that match candidates with relevant job opportunities based on skills, experience, and preferences.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Employer Services</h3>
                            <p class="text-gray-600">Comprehensive recruitment solutions including job posting, candidate screening, and applicant tracking systems.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Career Guidance</h3>
                            <p class="text-gray-600">Professional career counseling, resume building tools, and interview preparation resources to help job seekers succeed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Team Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Meet Our Team</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Our dedicated team of professionals working to make your job search and hiring experience exceptional
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow duration-300">
                <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
                         alt="Sohan Kafle" 
                         class="w-20 h-20 rounded-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Sohan Kafle</h3>
                <p class="text-indigo-600 font-medium mb-3">CEO & Founder</p>
                <p class="text-gray-600 text-sm">Leading the company with over 15 years of experience in recruitment and technology innovation.</p>
            </div>
            
            <!-- Team Member 2 -->
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow duration-300">
                <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
                         alt="Ishika Sigdel" 
                         class="w-20 h-20 rounded-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Ishika Sigdel</h3>
                <p class="text-indigo-600 font-medium mb-3">Head of Operations</p>
                <p class="text-gray-600 text-sm">Ensuring smooth operations and exceptional service delivery across all our platform features.</p>
            </div>
            
            <!-- Team Member 3 -->
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow duration-300">
                <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
                         alt="Subash Adhikari" 
                         class="w-20 h-20 rounded-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Subash Adhikari</h3>
                <p class="text-indigo-600 font-medium mb-3">Head of Technology</p>
                <p class="text-gray-600 text-sm">Driving technical innovation and maintaining the cutting-edge technology that powers our platform.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Start Your Journey?</h2>
        <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
            Join thousands of professionals who have found their dream jobs through our platform
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                Get Started Today
            </a>
            <a href="{{ route('job') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition-colors duration-200">
                Browse Jobs
            </a>
        </div>
    </div>
</section>

@endsection