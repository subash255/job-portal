@extends('user.layout')

@section('user-content')
    <div class="space-y-8">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Settings</h1>
                    <p class="text-gray-600">Manage your account settings and preferences</p>
                </div>
            </div>
        </div>

        <!-- Settings Sections -->
        <div class="grid gap-8">
            <!-- Account Settings -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="ri-settings-3-line text-indigo-500"></i>
                    Account Settings
                </h3>

                <div class="space-y-6">
                    <!-- Change Password -->
                    <div class="border-b border-gray-200 pb-6">
                        <h4 class="font-semibold text-gray-800 mb-4">Change Password</h4>

                        @if (session('success'))
                            <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="flex items-center gap-2">
                                    <i class="ri-check-circle-line text-green-600"></i>
                                    <span class="text-green-800 font-medium">{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="ri-error-warning-line text-red-600"></i>
                                    <span class="text-red-800 font-medium">Please fix the following errors:</span>
                                </div>
                                <ul class="text-red-700 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('user.change-password') }}" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Current Password
                                    </label>
                                    <input type="password" id="current_password" name="current_password" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('current_password') border-red-500 @enderror">
                                    @error('current_password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        New Password
                                    </label>
                                    <input type="password" id="new_password" name="new_password" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('new_password') border-red-500 @enderror">
                                    @error('new_password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label for="new_password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Confirm New Password
                                    </label>
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>
                            <button type="submit"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                                Update Password
                            </button>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>

    <script>
        // Auto-hide success messages after 5 seconds
        setTimeout(function() {
            const successMessages = document.querySelectorAll('.bg-green-50');
            successMessages.forEach(function(message) {
                message.style.transition = 'opacity 0.5s ease-out';
                message.style.opacity = '0';
                setTimeout(function() {
                    message.remove();
                }, 500);
            });
        }, 5000);

        // Form validation for password change
        document.querySelector('form[action="{{ route('user.change-password') }}"]').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('new_password_confirmation').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('New passwords do not match!');
                return false;
            }

            if (newPassword.length < 8) {
                e.preventDefault();
                alert('New password must be at least 8 characters long!');
                return false;
            }
        });
    </script>
@endsection
