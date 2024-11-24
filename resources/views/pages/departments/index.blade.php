@extends('template')

@section('currentPageName')
    Departments
@endsection

@section('content')
    @include('partials.successAlert')
    @include('partials.errorAlert')
    @if(\App\Facades\AuthUserFacade::hasPermission('departments-create'))
        <a class="btn btn-primary m-2" href="{{ route('departments.view.create') }}">Add department</a>
    @endif
    @if(!is_null($departments))
        @include('partials.pagination', ['paginator' => $departments])
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
                @foreach($departments as $department)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->description }}</td>
                        @if( $department->is_active === 1 )
                            <td class="text-success">Active</td>
                        @else
                            <td class="text-danger">Inactive</td>
                        @endif
                        <td>
                            <a href="{{ route(name: 'departments.permalink', parameters: [ 'department' => $department->id] ) }}"
                               class="btn btn-outline-primary">
                                View
                            </a>
                            @if(\App\Facades\AuthUserFacade::hasPermission('department-history'))
                                <a href="{{ route(name: 'departments.history', parameters: [ 'department' => $department->id] ) }}" class="btn btn-outline-secondary">
                                    History
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', ['paginator' => $departments])
    @endif
@endsection
