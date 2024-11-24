@extends('adminPanelTemplate')

@section('currentPageName')
    Users
@endsection

@section('content')
    @include('partials.errorAlert')
    @include('partials.successAlert')
    @if(\App\Facades\AuthUserFacade::hasPermission('admin-users-create'))
        <a class="btn btn-primary m-2" href="{{ route('admin.users.view.create') }}">Add user</a>
    @endif
    @if(!is_null($users))
        @include('partials.pagination', [ 'paginator' => $users])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if( $user->is_active === 1 )
                            <td class="text-success">Active</td>
                        @else
                            <td class="text-danger">Inactive</td>
                        @endif
                        <td>
                            <a class="btn btn-outline-secondary" href="{{ route('admin.users.permalink', [ 'user' => $user->id] ) }}">View</a>
                            @if(\App\Facades\AuthUserFacade::hasPermission('admin-users-groups-view'))
                                <a class="btn btn-outline-secondary" href="{{ route('admin.users.groups', [ 'user' => $user->id] ) }}">Groups</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', [ 'paginator' => $users])
    @endif
@endsection
