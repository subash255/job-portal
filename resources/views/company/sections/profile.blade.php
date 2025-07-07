<!-- Profile Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Company Profile</h1>
            <p class="text-gray-600 mt-1">Manage your company information and settings</p>
        </div>
        <div class="flex items-center space-x-4">
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="ri-save-line mr-2"></i>Save Changes
            </button>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto">
    <!-- Company Info Section -->
    <div class="mb-8">
        <!-- Company Info Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Company Information</h3>
                
                <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Industry</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option>Technology</option>
                            <option>Healthcare</option>
                            <option>Finance</option>
                            <option>Education</option>
                            <option>Marketing</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Size</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option>1-10 employees</option>
                            <option>11-50 employees</option>
                            <option>51-200 employees</option>
                            <option>201-500 employees</option>
                            <option>500+ employees</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Founded Year</label>
                        <input type="number" placeholder="2020" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Description</label>
                    <textarea rows="4" placeholder="Tell us about your company..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                        <input type="url" placeholder="https://www.company.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" placeholder="+977 98XXXXXXXX" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>                </form>
            </div>
        </div>
    </div>

    <!-- Company Logo Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Company Logo</h3>
        
        <div class="flex items-center justify-center">
            <div class="text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                    <i class="ri-building-line text-4xl text-white"></i>
                </div>
                <p class="text-sm text-gray-600 mb-4">Upload your company logo (Max 2MB)</p>
                <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="ri-upload-line mr-2"></i>Choose File
                </button>
            </div>
        </div>
    </div>

    <!-- Location Information -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Location Information</h3>
            
            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" placeholder="Street Address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                        <input type="text" placeholder="Kathmandu" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                        <input type="text" placeholder="Bagmati" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                        <input type="text" placeholder="44600" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option>Nepal</option>
                        <option>India</option>
                        <option>United States</option>
                        <option>United Kingdom</option>
                        <option>Canada</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Social Media Links -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Social Media & Links</h3>
            
            <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ri-linkedin-line text-gray-400"></i>
                            </div>
                            <input type="url" placeholder="https://linkedin.com/company/..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Twitter</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ri-twitter-line text-gray-400"></i>
                            </div>
                            <input type="url" placeholder="https://twitter.com/..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ri-facebook-line text-gray-400"></i>
                            </div>
                            <input type="url" placeholder="https://facebook.com/..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ri-instagram-line text-gray-400"></i>
                            </div>
                            <input type="url" placeholder="https://instagram.com/..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
