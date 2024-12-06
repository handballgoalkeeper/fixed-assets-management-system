@extends('blade-frontend.adminPanelTemplate')

@section('currentPageName')
    Permissions
@endsection

@section('content')
    @include('blade-frontend.partials.errorAlert')
    @include('blade-frontend.partials.successAlert')
    <div class="container-fluid">
        @include('blade-frontend.partials.pagination', ['paginator' => $assignedPermissions])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($assignedPermissions as $permission)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            @if(\App\Facades\AuthUserFacade::hasPermission('admin-groups-permissions-revoke'))
                                <a class="btn btn-danger"
                                   href="{{ route('admin.groups.revokePermission', [ 'group' => $group->id ,'permission' => $permission->id ] ) }}">Revoke</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('blade-frontend.partials.pagination', ['paginator' => $assignedPermissions])
        @if(\App\Facades\AuthUserFacade::hasPermission('admin-groups-permissions-grant'))
            <form action="{{ route('admin.groups.grantPermission', [ 'group' => $group->id ] ) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <select class="form-control mb-3" id="permission" name="selectedPermission">
                            <option selected disabled>Please select permission</option>
                            @foreach($allPermissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                        <button class="btn btn-success" type="submit">Grant permission</button>
                    </div>
                </div>
            </form>
        @endif
        <hr>
        <div class="float-end">
            <a class="btn btn-secondary" href="{{ route('admin.groups.index') }}">Back</a>
        </div>
    </div>
@endsection
