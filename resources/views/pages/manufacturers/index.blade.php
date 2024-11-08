@extends('template')

@section('currentPageName')
    Manufacturers
@endsection

@section('content')
    @if(!is_null(session('success')))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped table-responsive-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($manufacturers as $manufacturer)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $manufacturer->name }}</td>
                    <td>{{ $manufacturer->description }}</td>
                    <td>
                        <a href="{{ route(name: 'manufacturers.permalink', parameters: [ 'manufacturer' => $manufacturer->id] ) }}" class="btn btn-outline-primary">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
