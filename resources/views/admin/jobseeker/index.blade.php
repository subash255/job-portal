@extends('layouts.app')
@section('content')

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

<div class="p-4 bg-white shadow-lg -mt-12 mx-4 z-20 rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Jobseekers List</h2>

    <div class="overflow-x-auto">
        <table id="jobseekersTable" class="min-w-full border-separate border-spacing-0 border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">S.N</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Phone</th>
                    <th class="border px-4 py-2">Skills</th>
                    <th class="border px-4 py-2">Experience</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobseekers as $jobseeker)
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $jobseeker->name }}</td>
                        <td class="border px-4 py-2">{{ $jobseeker->email }}</td>
                        <td class="border px-4 py-2">{{ $jobseeker->phone }}</td>
                        <td class="border px-4 py-2">{{ $jobseeker->skills }}</td>
                        <td class="border px-4 py-2">{{ $jobseeker->experience }} yrs</td>
                        <td class="px-2 py-2 flex justify-center space-x-2 border">
                            <button type="button"
                                onclick="openDeleteModal({{ $jobseeker->id }})"
                                class="bg-red-500 hover:bg-red-700 p-2 w-8 h-8 rounded-full flex items-center justify-center">
                                <i class="ri-delete-bin-line text-white"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    <div id="deleteModal-{{ $jobseeker->id }}"
                        class="fixed inset-0 bg-black bg-opacity-70 modal-hidden items-center justify-center z-50 backdrop-blur-[1px] flex">
                        <div class="bg-white p-6 rounded-lg w-96">
                            <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
                            <p>Are you sure you want to delete <strong>{{ $jobseeker->name }}</strong>?</p>
                            <div class="mt-4 flex justify-end">
                                <button class="bg-gray-400 hover:bg-gray-600 text-white p-2 rounded-md mr-2"
                                    onclick="closeDeleteModal({{ $jobseeker->id }})">Cancel</button>
                                <form action="{{ route('admin.jobseekers.destroy', $jobseeker->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
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
    function openDeleteModal(id) {
        const modal = document.getElementById(`deleteModal-${id}`);
        modal.classList.remove('modal-hidden');
        modal.classList.add('modal-visible');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal(id) {
        const modal = document.getElementById(`deleteModal-${id}`);
        modal.classList.remove('modal-visible');
        modal.classList.add('modal-hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>

<script>
    $(document).ready(function () {
        $('#jobseekersTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            initComplete: function () {
                $('.dataTables_length').addClass('flex items-center gap-2 mb-4');
                $('select').addClass('bg-gray-50 border text-sm rounded-lg p-2 w-[4rem]');
            }
        });
    });
</script>

<style>
    .modal-hidden { display: none !important; }
    .modal-visible { display: flex !important; }
</style>

@endsection
