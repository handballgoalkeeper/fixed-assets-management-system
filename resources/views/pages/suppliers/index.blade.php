@extends('template')

@section('currentPageName')
    Suppliers
@endsection

@section('content')
    @include('partials.successAlert')
    @include('partials.errorAlert')
    <a class="btn btn-primary m-2" href="{{ route('suppliers.view.create') }}">Add supplier</a>
    @if(!is_null($suppliers))
    @include('partials.pagination', ['paginator' => $suppliers])
    <div class="container-flow table-responsive">
        <table class="table table-striped table-responsive-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">PIB</th>
                <th scope="col">Contact person</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->description }}</td>
                    <td>{{ $supplier->PIB }}</td>
                    <td>{{ $supplier->contact_person }}</td>
                    @if( $supplier->is_active === 1 )
                        <td class="text-success">Active</td>
                    @else
                        <td class="text-danger">Inactive</td>
                    @endif
                    <td>
                        <a href="{{ route(name: 'suppliers.permalink', parameters: [ 'supplier' => $supplier->id] ) }}" class="btn btn-outline-primary">
                            View
                        </a>
{{--                        <a href="{{ route(name: 'manufacturers.history', parameters: [ 'manufacturer' => $supplier->id] ) }}" class="btn btn-outline-secondary">--}}
{{--                            History--}}
{{--                        </a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('partials.pagination', ['paginator' => $suppliers])
    @endif
@endsection
