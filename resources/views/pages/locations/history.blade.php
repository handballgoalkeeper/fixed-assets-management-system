@extends('template')

@section('currentPageName')
    Location history
@endsection

@section('content')
    @include('partials.successAlert')
    @include('partials.errorAlert')

    <div class="container-flow">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <a class="btn btn-secondary m-2" href="{{ route('locations.index') }}">Back</a>
            </div>
        </div>
    </div>
    @if(!is_null($locationHistory))
        @include('partials.pagination', ['paginator' => $locationHistory])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Action</th>
                    <th scope="col">Alias</th>
                    <th scope="col">Street name</th>
                    <th scope="col">Street number</th>
                    <th scope="col">City</th>
                    <th scope="col">Status</th>
                    <th scope="col">Modified by</th>
                    <th scope="col">Modified at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($locationHistory as $row)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $row->action }}</td>
                        <td>{{ $row->alias }}</td>
                        <td>{{ $row->street_name }}</td>
                        <td>{{ $row->street_number }}</td>
                        <td>{{ $row->city }}</td>
                        @if( $row->is_active === 1 )
                            <td class="text-success">Active</td>
                        @else
                            <td class="text-danger">Inactive</td>
                        @endif
                        <td>{{ $row->modified_by }}</td>
                        <td>{{ $row->timestamp }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', ['paginator' => $locationHistory])
    @endif
@endsection
