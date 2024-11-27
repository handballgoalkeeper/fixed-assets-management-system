@extends('template')

@section('currentPageName')
    Employees
@endsection

@section('content')
    @include('partials.successAlert')
    @include('partials.errorAlert')
    @if(\App\Facades\AuthUserFacade::hasPermission('employees-create'))
        <a class="btn btn-primary m-2" href="{{ route('employees.view.create') }}">Add employee</a>
    @endif
    @if(!is_null($employees))
        @include('partials.pagination', ['paginator' => $employees])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        @if( $employee->is_active === 1 )
                            <td class="text-success">Active</td>
                        @else
                            <td class="text-danger">Inactive</td>
                        @endif
                        <td>
                            <a href="{{ route(name: 'employees.permalink', parameters: [ 'employee' => $employee->id] ) }}"
                               class="btn btn-outline-primary">
                                View
                            </a>
{{--                            @if(\App\Facades\AuthUserFacade::hasPermission('employees-history'))--}}
{{--                                <a href="{{ route(name: 'employees.history', parameters: [ 'manufacturer' => $employee->id] ) }}"--}}
{{--                                   class="btn btn-outline-secondary">--}}
{{--                                    History--}}
{{--                                </a>--}}
{{--                            @endif--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', ['paginator' => $employees])
    @endif
@endsection
