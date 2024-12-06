@extends('blade-frontend.template')

@section('currentPageName')
    Supplier history
@endsection

@section('content')
    @include('blade-frontend.partials.successAlert')
    @include('blade-frontend.partials.errorAlert')

    <div class="container-flow">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <a class="btn btn-secondary m-2" href="{{ route('suppliers.index') }}">Back</a>
            </div>
        </div>
    </div>
    @if(!is_null($supplierHistory))
        @include('blade-frontend.partials.pagination', [ 'paginator' => $supplierHistory ])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Action</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">PIB</th>
                    <th scope="col">Contact person</th>
                    <th scope="col">Status</th>
                    <th scope="col">Modified by</th>
                    <th scope="col">Modified at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($supplierHistory as $row)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $row->action }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->pib }}</td>
                        <td>{{ $row->contact_person }}</td>
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
        @include('blade-frontend.partials.pagination', [ 'paginator' => $supplierHistory ])
    @endif
@endsection
