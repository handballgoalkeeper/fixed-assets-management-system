@extends('adminPanelTemplate')

@section('currentPageName')
    Users
@endsection

@section('content')
    @include('partials.errorAlert')
    @include('partials.successAlert')
    @if(!is_null($users))
        @include('partials.pagination', [ 'paginator' => $users])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $permission)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->email }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', [ 'paginator' => $users])
    @endif
@endsection
