@extends('layouts.app')
@section('content')
    <style>
        /* Hide the modal */
        .modal-hidden {
            display: none !important;
        }

        /* Show the modal with flex */
        .modal-visible {
            display: flex !important;
        }
    </style>
    {{-- Flash Message --}}
    @if (session('success'))
        <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    <script>
        if (document.getElementById('flash-message')) setTimeout(() => {
            const msg = document.getElementById('flash-message');
            msg.style.opacity = 0;
            msg.style.transition = "opacity 0.5s ease-out";
            setTimeout(() => msg.remove(), 500);
        }, 3000);
    </script>

    <div class="p-4 bg-white shadow-lg -mt-12 mx-4 z-20 rounded-lg">
        <div class="mb-4 flex justify-end">
            <a href="{{ route('category.create') }}" 
                class="text-red-500 font-medium bg-white border-2 border-red-500 rounded-lg py-2 px-4 hover:bg-red-600 hover:text-white transition duration-300">
                Add Jobs
            </a>
        </div>

       


        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table id="categoryTable" class="min-w-full border-separate border-spacing-0 border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">S.N</th>
                        <th class="border border-gray-300 px-4 py-2"> Name</th>
                        <th class="border border-gray-300 px-4 py-2">Slug</th>
                        <th class="border border-gray-300 px-4 py-2">position</th>
                        <th class="border border-gray-300 px-4 py-2">Descriptiont</th>
                        <th class="border border-gray-300 px-4 py-2">Image</th>
                        <th class="border border-gray-300 px-4 py-2">Company Name</th>
                        <th class="border border-gray-300 px-4 py-2">Start Date</th>
                        <th class="border border-gray-300 px-4 py-2">End Date</th>
                        <th class="border border-gray-300 px-4 py-2">Location</th>
                        <th class="border border-gray-300 px-4 py-2">Salary</th>
                        <th class="border border-gray-300 px-4 py-2">Expected requirement</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $category->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $category->slug }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <label for="status{{ $category->id }}" class="inline-flex items-center cursor-pointer">
                                    <input id="status{{ $category->id }}" type="checkbox" class="hidden toggle-switch" data-id="{{ $category->id }}" {{ $category->status ? 'checked' : '' }} />
                                    <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                                        <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
                                    </div>
                                </label>
                            </td>
                            <td class="px-2 py-2 flex justify-center space-x-4 border border-gray-300">
                                <!-- Edit Icon -->
                                <a href="{{ route('category.edit', ['id' => $category->id]) }}"
                                    class="bg-blue-500 hover:bg-blue-700 p-2 w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="ri-edit-box-line text-white"></i>
                                </a>
                                <!-- Delete Icon -->
                                <button type="button" onclick="openDeleteModal({{ $category->id }})"
                                    class="bg-red-500 hover:bg-red-700 p-2 w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="ri-delete-bin-line text-white"></i>
                                </button>
                                <!-- Settings Icon -->
                                {{-- <form action="#" method="get">
                                    @csrf
                                    <button
                                        class="bg-green-500 hover:bg-green-700 p-2 w-10 h-10 rounded-full flex items-center justify-center">
                                        <i class="ri-settings-5-line text-white"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        <!--  DeleteModal HTML -->
                        <div id="deleteModal-{{ $category->id }}"
                            class="fixed inset-0 bg-black bg-opacity-70 modal-hidden items-center justify-center z-50 backdrop-blur-[1px] flex">
                            <div class="bg-white p-6 rounded-lg w-96">
                                <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
                                <p>Are you sure you want to delete this category?</p>
                                <div class="mt-4 flex justify-end">
                                    <button id="cancelBtn"
                                        class="bg-gray-400 hover:bg-gray-600 text-white p-2 rounded-md mr-2"
                                        onclick="closeDeleteModal({{ $category->id }})">Cancel</button>
                                    <form action="{{ route('category.delete', $category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white p-2 rounded-md">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            
        </div>


    </div>

    <script>
        document.querySelectorAll('.toggle-switch').forEach(toggle => {
       const dot = toggle.parentNode.querySelector('.dot'); // The visual dot for the toggle switch
   
       // Apply the correct initial state (visual toggle)
       if (toggle.checked) {
           dot.style.transform = 'translateX(100%)';
           dot.style.backgroundColor = 'green';
       } else {
           dot.style.transform = 'translateX(0)';
           dot.style.backgroundColor = 'white';
       }
   
       // Add event listener to handle checkbox state change
       toggle.addEventListener('change', function() {
           const categoryId = this.getAttribute('data-id'); // Get the category ID from the data-id attribute
           const newState = this.checked ? 1 : 0; // 1 for checked, 0 for unchecked
   
           // Toggle visual effect of the switch
           if (this.checked) {
               dot.style.transform = 'translateX(100%)';
               dot.style.backgroundColor = 'green';
           } else {
               dot.style.transform = 'translateX(0)';
               dot.style.backgroundColor = 'white';
           }
   
           // Send AJAX request to update the status
           fetch(`/category/status-toggle/${categoryId}`, {
               method: 'POST',
               headers: {
                   'Content-Type': 'application/json',
                   'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for security
               },
               body: JSON.stringify({
                   state: newState, // The new state (1 or 0)
                   type: 'status',  // Indicate we're updating the status
               }),
           })
           .then(response => response.json())
           .then(data => {
               if (!data.success) {
                   // If update fails, reset the toggle state
                   this.checked = !this.checked;
                   dot.style.transform = this.checked ? 'translateX(100%)' : 'translateX(0)';
                   dot.style.backgroundColor = this.checked ? 'green' : 'white';
               }
           })
           .catch(error => {
               console.error('Error:', error);
               // Reset the toggle state in case of an error
               this.checked = !this.checked;
               dot.style.transform = this.checked ? 'translateX(100%)' : 'translateX(0)';
               dot.style.backgroundColor = this.checked ? 'green' : 'white';
           });
       });
   });
    </script>

    <script>
        // Function to generate slug from category name
        function generateSlug() {
            let input1 = document.getElementById('category').value;
            let slug = input1.trim().replace(/\s+/g, '-').toLowerCase();
            document.getElementById('slug').value = slug;
        }

        // Open the modal
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('categoryModal').classList.remove('modal-hidden');
            document.getElementById('categoryModal').classList.add('modal-visible'); // Show modal
            document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open
        });

        // Close the modal
        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('categoryModal').classList.remove('modal-visible');
            document.getElementById('categoryModal').classList.add('modal-hidden'); // Hide modal
            document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
        });

        function openDeleteModal(userId) {
        const deleteModal = document.getElementById(`deleteModal-${userId}`);
        deleteModal.classList.remove('modal-hidden');
        deleteModal.classList.add('modal-visible');
        document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open
    }

    // Close the modal
    function closeDeleteModal(userId) {
        const deleteModal = document.getElementById(`deleteModal-${userId}`);
        deleteModal.classList.remove('modal-visible');
        deleteModal.classList.add('modal-hidden');
        document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
    }
    </script>

    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                lengthChange: true,
                initComplete: function() {
                    $('.dataTables_length').addClass('flex items-center gap-2 mb-4');
                    $('select').addClass(
                        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 w-[4rem]'
                        );
                }
            });
        });
    </script>
@endsection
