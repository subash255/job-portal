<!-- Profile Header -->
@if (session('success'))
    <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif

<script>
    if (document.getElementById('flash-message')) {
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            msg.style.opacity = 0;
            msg.style.transition = "opacity 0.5s ease-out";
            setTimeout(() => msg.remove(), 500);
        }, 3000);
    }
</script> 
<form method="POST" action="{{ route('company.profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Company Profile</h1>
            <p class="text-gray-600 mt-1">Manage your company information and settings</p>
        </div>
        <div class="flex items-center space-x-4">
            <button  type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
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

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Industry</label>
                        <select name="industry" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Select industry</option>
                            <option value="Technology" {{ old('industry', auth()->user()->industry) == 'Technology' ? 'selected' : '' }}>Technology</option>
                            <option value="Healthcare" {{ old('industry', auth()->user()->industry) == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                            <option value="Finance" {{ old('industry', auth()->user()->industry) == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Education" {{ old('industry', auth()->user()->industry) == 'Education' ? 'selected' : '' }}>Education</option>
                            <option value="Marketing" {{ old('industry', auth()->user()->industry) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        </select>

                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Size</label>
                        <select name="company_size" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Select company size</option>
                            <option value="1-10 employees" {{ old('company_size', auth()->user()->company_size) == '1-10 employees' ? 'selected' : '' }}>1–10 employees</option>
                            <option value="11-50 employees" {{ old('company_size', auth()->user()->company_size) == '11-50 employees' ? 'selected' : '' }}>11–50 employees</option>
                            <option value="51-200 employees" {{ old('company_size', auth()->user()->company_size) == '51-200 employees' ? 'selected' : '' }}>51–200 employees</option>
                            <option value="201-500 employees" {{ old('company_size', auth()->user()->company_size) == '201-500 employees' ? 'selected' : '' }}>201–500 employees</option>
                            <option value="500+ employees" {{ old('company_size', auth()->user()->company_size) == '500+ employees' ? 'selected' : '' }}>500+ employees</option>
                        </select>

                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Founded Year</label>
                        <input type="number" value="{{ auth()->user()->founded_year }}" name="founded_year" placeholder="2020" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Description</label>
                    <textarea rows="4" name="description"  placeholder="Tell us about your company..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none">{{ old('description', auth()->user()->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                        <input type="url" name="company_website" value="{{ auth()->user()->company_website }}" placeholder="https://www.company.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone" value="{{ auth()->user()->phone }}" placeholder="+977 98XXXXXXXX" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Company Logo Section -->


<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Company Logo</h3>

        <div class="flex items-center justify-center">
            <div class="text-center">
                @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Company Logo"
                         class="w-32 h-32 object-cover rounded-2xl mx-auto mb-4">
                @else
                    <div class="w-32 h-32 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <i class="ri-building-line text-4xl text-white"></i>
                    </div>
                @endif

                <p class="text-sm text-gray-600 mb-4">Upload your company logo (Max 2MB)</p>

                <input type="file" name="profile_picture" accept="image/*"
                       class="block mx-auto text-sm text-gray-600 mb-2">
            </div>
        </div>
    </div>
<!-- Location Information -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
    <h3 class="text-xl font-bold text-gray-800 mb-6">Location Information</h3>

    <div class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
            <input type="text" name="address"  value="{{ auth()->user()->address }}"placeholder="Street Address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                <input type="text" name="city" value="{{ auth()->user()->city }}" placeholder="Kathmandu" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                <input type="text" name="state" value="{{ auth()->user()->state }}" placeholder="Bagmati" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                <input type="text" name="postal_code" value="{{ auth()->user()->postal_code }}" placeholder="44600" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
            <select name="country" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option value="nepal">Nepal</option>
                <option value="india">India</option>
                <option value="united state">United States</option>
                <option value="united kingdom">United Kingdom</option>
                <option value="canada">Canada</option>
            </select>
        </div>
    </div>
</div>

<!-- Social Media Links -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
    <h3 class="text-xl font-bold text-gray-800 mb-6">Social Media & Links</h3>

    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="ri-linkedin-line text-gray-400"></i>
                    </div>
                    <input type="url" name="linkedin" value="{{ auth()->user()->linkedin }}" placeholder="https://linkedin.com/company/..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Twitter</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="ri-twitter-line text-gray-400"></i>
                    </div>
                    <input type="url" name="company_twitter" value="{{ auth()->user()->company_twitter }}" placeholder="https://twitter.com/..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
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
                    <input type="url" name="company_facebook"value="{{ auth()->user()->company_facebook }}" placeholder="https://facebook.com/..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="ri-instagram-line text-gray-400"></i>
                    </div>
                    <input type="url" name="company_instagram" value="{{ auth()->user()->company_instagram }}" placeholder="https://instagram.com/..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
            </div>
        </div>
</div>
</div>
</div>
</div>
</form>