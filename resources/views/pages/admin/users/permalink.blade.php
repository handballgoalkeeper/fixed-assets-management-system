@extends('adminPanelTemplate')

@section('currentPageName')
    Users - Permalink
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ route( 'admin.users.update', [ 'user' => $user->id] ) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="nameInput">Name:</label>
                <input type="text" class="form-control" id="nameInput" name="name" value="{{ $user->name }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="emailInput">Email:</label>
                <input type="email" class="form-control" id="emailInput" name="email" value="{{ $user->email }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="statusSelect">Status</label>
                <select class="form-control mb-3" id="statusSelect" name="isActive">
                    <option value="1" {{ $user->is_active === 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ $user->is_active === 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success">Save</button>
                <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
