@extends('template')

@section('currentPageName')
    Locations
@endsection

@section('content')
    @include('partials.successAlert')
    @include('partials.errorAlert')
    <a class="btn btn-primary m-2" href="{{ route('locations.view.create') }}">Add location</a>
    @if(!is_null($locations))
        @include('partials.pagination', [ 'paginator' => $locations ])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Alias</th>
                    <th scope="col">Street name</th>
                    <th scope="col">Street number</th>
                    <th scope="col">City</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($locations as $location)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $location->alias }}</td>
                        <td>{{ $location->street_name }}</td>
                        <td>{{ $location->street_number }}</td>
                        <td>{{ $location->city }}</td>
                        @if( $location->street_number === 1 )
                            <td class="text-success">Active</td>
                        @else
                            <td class="text-danger">Inactive</td>
                        @endif
                        <td>
                            <a href="{{ route(name: 'departments.permalink', parameters: [ 'department' => $location->id] ) }}"
                               class="btn btn-outline-primary">
                                View
                            </a>
                            <a href="{{ route(name: 'departments.history', parameters: [ 'department' => $location->id] ) }}" class="btn btn-outline-secondary">
                                History
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', [ 'paginator' => $locations ])
    @endif
@endsection
