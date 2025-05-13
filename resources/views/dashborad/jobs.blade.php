<button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New Job</button>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Company</th>
            <th>Category</th>
            <th>Type</th>          
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jobs as $job)
        <tr>

            <td></td>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Edit</button>
                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>