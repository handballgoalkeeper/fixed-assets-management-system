@extends('blade-frontend.adminPanelTemplate')

@section('currentPageName')
    Groups
@endsection

@section('content')
    @include('blade-frontend.partials.errorAlert')
    @include('blade-frontend.partials.successAlert')
    <div class="container-fluid">
        @include('blade-frontend.partials.pagination', ['paginator' => $assignedGroups])
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
                @foreach($assignedGroups as $group)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->description }}</td>
                        <td>
                            @if(\App\Facades\AuthUserFacade::hasPermission('admin-users-groups-revoke'))
                                <a class="btn btn-danger"
                                   href="{{ route('admin.users.revokeGroup', [ 'user' => $user->id ,'group' => $group->id ] ) }}">Revoke</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('blade-frontend.partials.pagination', ['paginator' => $assignedGroups])
        @if(\App\Facades\AuthUserFacade::hasPermission('admin-users-groups-grant'))
            <form action="{{ route('admin.users.grantGroup', [ 'user' => $user->id ] ) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <select class="form-control mb-3" id="group" name="selectedGroup">
                            <option selected disabled>Please select group</option>
                            @foreach($allGroups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                        <button class="btn btn-success" type="submit">Grant group</button>
                    </div>
                </div>
            </form>
        @endif
        <hr>
        <div class="float-end">
            <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Back</a>
        </div>
    </div>
@endsection
