@extends('adminPanelTemplate')

@section('currentPageName')
    Groups
@endsection

@section('content')
    @include('partials.errorAlert')
    @include('partials.successAlert')
    <div class="container-fluid">
        @include('partials.pagination', ['paginator' => $assignedGroups])
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
{{--                            <a class="btn btn-danger" href="{{ route('admin.users.revokeGroup', [ 'group' => $group->id ,'permission' => $permission->id ] ) }}">Revoke</a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', ['paginator' => $assignedGroups])
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
        <hr>
        <div class="float-end">
            <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Back</a>
        </div>
    </div>
@endsection
