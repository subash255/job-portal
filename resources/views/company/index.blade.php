@extends('layouts.company')
@section('content')
 
      
    
        <!-- Dashboard Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Jobs Posted -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 text-center">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Total Jobs Posted</h3>
                <p class="text-4xl font-extrabold text-indigo-600">10</p>
            </div>

            <!-- Applications Received -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 text-center">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Applications Received</h3>
                <p class="text-4xl font-extrabold text-green-600">42</p>
            </div>

            <!-- Post New Job -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-center">
                <a href="{{route('company.create')}}"
                    class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                    + Post New Job
                </a>
            </div>
        </div>

        <!-- Recent Job Posts -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Recent Job Posts</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left text-gray-700">
                    <thead>
                        <tr class="border-b text-gray-600">
                            <th class="pb-2">Title</th>
                            <th class="pb-2">Location</th>
                            <th class="pb-2">Status</th>
                            <th class="pb-2">Posted On</th>
                            <th class="pb-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Job Row Example -->
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2">Frontend Developer</td>
                            <td class="py-2">Kathmandu</td>
                            <td class="py-2">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    Active
                                </span>
                            </td>
                            <td class="py-2">July 5, 2025</td>
                            <td class="py-2 space-x-2">
                                <a href="#" class="text-blue-600 hover:underline">Edit</a>
                                <button onclick="alert('Delete clicked')" class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>

                        <!-- If No Jobs -->
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">No job postings yet.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
   

@endsection