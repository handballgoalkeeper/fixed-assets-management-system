@extends('adminPanelTemplate')

@section('currentPageName')
    Groups
@endsection

@section('content')
    @include('partials.errorAlert')
    @include('partials.successAlert')
    <a class="btn btn-primary m-2" href="{{ route('admin.groups.view.create') }}">Add group</a>
    @if(!is_null($groups))
        @include('partials.pagination', [ 'paginator' => $groups])
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
                @foreach($groups as $group)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->description }}</td>
                        @if( $group->is_active === 1 )
                            <td class="text-success">Active</td>
                        @else
                            <td class="text-danger">Inactive</td>
                        @endif
                        <td>
                            <a class="btn btn-outline-secondary" href="{{ route('admin.groups.permalink', [ 'group' => $group->id]) }}">View</a>
                            <a class="btn btn-outline-secondary" href="{{ route('admin.groups.permissions', [ 'group' => $group->id]) }}">Permissions</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', [ 'paginator' => $groups])
    @endif
@endsection
