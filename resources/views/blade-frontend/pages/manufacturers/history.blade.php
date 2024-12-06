@extends('blade-frontend.template')

@section('currentPageName')
    Manufacturer history
@endsection

@section('content')
    @include('blade-frontend.partials.successAlert')
    @include('blade-frontend.partials.errorAlert')

    <div class="container-flow">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <a class="btn btn-secondary m-2" href="{{ route('manufacturers.index') }}">Back</a>
            </div>
        </div>
    </div>
    @if(!is_null($manufacturerHistory))
        <div class="d-flex justify-content-center mt-4">
            {{ $manufacturerHistory->onEachSide(2)->links('pagination::bootstrap-5') }}
        </div>
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Action</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Modified by</th>
                    <th scope="col">Modified at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($manufacturerHistory as $row)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $row->action }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->description }}</td>
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
        <div class="d-flex justify-content-center mt-4">
            {{ $manufacturerHistory->onEachSide(2)->links('pagination::bootstrap-5') }}
        </div>
    @endif
@endsection
