@extends('blade-frontend.template')

@section('currentPageName')
    Locations
@endsection

@section('content')
    @include('blade-frontend.partials.successAlert')
    @include('blade-frontend.partials.errorAlert')
    @if(\App\Facades\AuthUserFacade::hasPermission('locations-create'))
        <a class="btn btn-primary m-2" href="{{ route('locations.view.create') }}">Add location</a>
    @endif
    @if(!is_null($locations))
        @include('blade-frontend.partials.pagination', [ 'paginator' => $locations ])
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
                        @if( $location->is_active === 1 )
                            <td class="text-success">Active</td>
                        @else
                            <td class="text-danger">Inactive</td>
                        @endif
                        <td>
                            <a href="{{ route(name: 'locations.permalink', parameters: [ 'location' => $location->id] ) }}"
                               class="btn btn-outline-primary">
                                View
                            </a>
                            @if(\App\Facades\AuthUserFacade::hasPermission('locations-history'))
                                <a href="{{ route(name: 'locations.history', parameters: [ 'location' => $location->id] ) }}"
                                   class="btn btn-outline-secondary">
                                    History
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('blade-frontend.partials.pagination', [ 'paginator' => $locations ])
    @endif
@endsection
