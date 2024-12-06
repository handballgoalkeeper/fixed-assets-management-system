@extends('blade-frontend.adminPanelTemplate')

@section('currentPageName')
    Permissions
@endsection

@section('content')
    @include('blade-frontend.partials.errorAlert')
    @include('blade-frontend.partials.successAlert')
    @if(!is_null($permissions))
        @include('blade-frontend.partials.pagination', [ 'paginator' => $permissions])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('blade-frontend.partials.pagination', [ 'paginator' => $permissions])
    @endif
@endsection
