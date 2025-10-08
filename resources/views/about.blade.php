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
                            <i class="ri-briefcase-line w-6 h-6 text-indigo-600 flex items-center justify-center" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Job Matching</h3>
                            <p class="text-gray-600">Advanced AI-powered algorithms that match candidates with relevant job opportunities based on skills, experience, and preferences.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="ri-group-line w-6 h-6 text-indigo-600 flex items-center justify-center" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Employer Services</h3>
                            <p class="text-gray-600">Comprehensive recruitment solutions including job posting, candidate screening, and applicant tracking systems.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="ri-user-star-line w-6 h-6 text-indigo-600 flex items-center justify-center" style="font-size: 24px;"></i>
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
<section class="py-10 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Meet Our Leadership Team</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Visionary leaders driving innovation and excellence in Nepal's job market, 
                committed to connecting talent with opportunity.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-4xl mx-auto">
            <!-- Team Member 1 - Sohan Kafle -->
            <div class="group h-full">
                <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 h-full flex flex-col">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full -translate-y-20 translate-x-20 opacity-50"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full translate-y-16 -translate-x-16 opacity-30"></div>
                    
                    <div class="relative p-10 flex-1 flex flex-col">
                        <!-- Profile Image -->
                        <div class="relative mx-auto mb-8 w-fit">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 p-1">
                                <img src="https://sohankafle.com.np/image/sohann.jpg" 
                                     alt="Sohan Kafle" 
                                     class="w-full h-full rounded-full object-cover">
                            </div>
                            <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center">
                                <i class="ri-verified-badge-fill text-white" style="font-size: 20px;"></i>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="text-center flex-1 flex flex-col">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Sohan Kafle</h3>
                            <div class="flex justify-center mb-6">
                                <div class="inline-flex items-center px-2 py-1 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full">
                                    <i class="ri-code-line text-indigo-600 mr-1" style="font-size: 12px;"></i>
                                    <span class="text-indigo-700 font-semibold text-xs">Full-Stack Developer</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-600 leading-relaxed mb-6 min-h-[4rem]">
                                    Experienced full-stack developer with expertise in modern web technologies. 
                                    Passionate about creating scalable applications and innovative solutions for job portal platforms.
                                </p>
                            </div>
                            
                            <!-- Skills/Expertise -->
                            <div class="flex flex-wrap gap-2 justify-center mb-6">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-600 text-xs rounded-full font-medium">JavaScript</span>
                                <span class="px-3 py-1 bg-purple-100 text-purple-600 text-xs rounded-full font-medium">React</span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-600 text-xs rounded-full font-medium">Laravel</span>
                                <span class="px-3 py-1 bg-green-100 text-green-600 text-xs rounded-full font-medium">PHP</span>
                            </div>
                            
                            <!-- Social Links -->
                            <div class="flex justify-center space-x-3">
                                <!-- Facebook -->
                                <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-blue-100 rounded-full flex items-center justify-center transition-colors duration-200">
                                    <i class="ri-facebook-fill text-gray-600 hover:text-blue-600" style="font-size: 20px;"></i>
                                </a>
                                <!-- LinkedIn -->
                                <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-blue-100 rounded-full flex items-center justify-center transition-colors duration-200">
                                    <i class="ri-linkedin-fill text-gray-600 hover:text-blue-600" style="font-size: 20px;"></i>
                                </a>
                                <!-- Website -->
                                <a href="https://sohankafle.com.np" class="w-10 h-10 bg-gray-100 hover:bg-green-100 rounded-full flex items-center justify-center transition-colors duration-200">
                                    <i class="ri-global-line text-gray-600 hover:text-green-600" style="font-size: 20px;"></i>
                                </a>
                                <!-- GitHub -->
                                <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-gray-800 rounded-full flex items-center justify-center transition-colors duration-200">
                                    <i class="ri-github-fill text-gray-600 hover:text-gray-800" style="font-size: 20px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 2 - Subash Adhikari -->
            <div class="group h-full">
                <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 h-full flex flex-col">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-purple-100 to-blue-100 rounded-full -translate-y-20 translate-x-20 opacity-50"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full translate-y-16 -translate-x-16 opacity-30"></div>
                    
                    <div class="relative p-10 flex-1 flex flex-col">
                        <!-- Profile Image -->
                        <div class="relative mx-auto mb-8 w-fit">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 p-1">
                                <img src="https://adhikarisubash.info.np/image/subash.jpg" 
                                     alt="Subash Adhikari" 
                                     class="w-full h-full rounded-full object-cover">
                            </div>
                            <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-gradient-to-r from-purple-500 to-blue-500 rounded-full flex items-center justify-center">
                                <i class="ri-verified-badge-fill text-white" style="font-size: 20px;"></i>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="text-center flex-1 flex flex-col">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Subash Adhikari</h3>
                            <div class="flex justify-center mb-6">
                                <div class="inline-flex items-center px-2 py-1 bg-gradient-to-r from-purple-100 to-blue-100 rounded-full">
                                    <i class="ri-code-line text-purple-600 mr-1" style="font-size: 12px;"></i>
                                    <span class="text-purple-700 font-semibold text-xs">Full-Stack Developer</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-600 leading-relaxed mb-6 min-h-[4rem]">
                                    Skilled full-stack developer specializing in modern web frameworks and cloud technologies. 
                                    Expert in building robust backend systems and intuitive user interfaces for complex applications.
                                </p>
                            </div>
                            
                            <!-- Skills/Expertise -->
                            <div class="flex flex-wrap gap-2 justify-center mb-6">
                                <span class="px-3 py-1 bg-purple-100 text-purple-600 text-xs rounded-full font-medium">Laravel</span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-600 text-xs rounded-full font-medium">PHP</span>
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-600 text-xs rounded-full font-medium">MySQL</span>
                                <span class="px-3 py-1 bg-green-100 text-green-600 text-xs rounded-full font-medium">AWS</span>
                            </div>
                            
                            <!-- Social Links -->
                            <div class="flex justify-center space-x-3">
                                <!-- Facebook -->
                                <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-blue-100 rounded-full flex items-center justify-center transition-colors duration-200">
                                    <i class="ri-facebook-fill text-gray-600 hover:text-blue-600" style="font-size: 20px;"></i>
                                </a>
                                <!-- LinkedIn -->
                                <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-blue-100 rounded-full flex items-center justify-center transition-colors duration-200">
                                    <i class="ri-linkedin-fill text-gray-600 hover:text-blue-600" style="font-size: 20px;"></i>
                                </a>
                                <!-- Website -->
                                <a href="https://adhikarisubash.info.np" class="w-10 h-10 bg-gray-100 hover:bg-green-100 rounded-full flex items-center justify-center transition-colors duration-200">
                                    <i class="ri-global-line text-gray-600 hover:text-green-600" style="font-size: 20px;"></i>
                                </a>
                                <!-- GitHub -->
                                <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-gray-800 rounded-full flex items-center justify-center transition-colors duration-200">
                                    <i class="ri-github-fill text-gray-600 hover:text-gray-800" style="font-size: 20px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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