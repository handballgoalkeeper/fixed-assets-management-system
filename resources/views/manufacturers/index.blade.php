<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @foreach($manufacturers as $manufacturer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $manufacturer->getAttribute('name') }}</td>
                <td>{{ $manufacturer->getAttribute('description') }}</td>
                <td>
                    <button>View</button>
                    <button>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
