@extends('template')

@section('currentPageName')
    Manufacturers
@endsection

@section('content')
    @include('partials.successAlert')
    @include('partials.errorAlert')
    <a class="btn btn-primary m-2" href="{{ route('manufacturers.view.create') }}">Add manufacturer</a>
    @if(!is_null($manufacturers))
        @include('partials.pagination', ['paginator' => $manufacturers])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($manufacturers as $manufacturer)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $manufacturer->name }}</td>
                        <td>{{ $manufacturer->description }}</td>
                        @if( $manufacturer->is_active === 1 )
                            <td class="text-success">Active</td>
                        @else
                            <td class="text-danger">Inactive</td>
                        @endif
                        <td>
                            <a href="{{ route(name: 'manufacturers.permalink', parameters: [ 'manufacturer' => $manufacturer->id] ) }}"
                               class="btn btn-outline-primary">
                                View
                            </a>
                            <a href="{{ route(name: 'manufacturers.history', parameters: [ 'manufacturer' => $manufacturer->id] ) }}"
                               class="btn btn-outline-secondary">
                                History
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', ['paginator' => $manufacturers])
    @endif
@endsection
