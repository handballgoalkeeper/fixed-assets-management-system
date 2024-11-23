@extends('adminPanelTemplate')

@section('currentPageName')
    Users - Add
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ route('admin.users.create') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="nameInput">Name:</label>
                <input type="text" class="form-control" id="nameInput" name="name" placeholder="Please enter users full name..."
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="emailInput">Email:</label>
                <input type="email" class="form-control" id="emailInput" name="email" placeholder="Please enter email..."
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="passwordInput">Password:</label>
                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Please enter password..."
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="reenterPasswordInput">Reenter password:</label>
                <input type="password" class="form-control" id="reenterPasswordInput" name="reenteredPassword" placeholder="Please reenter password..."
                       required/>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success">Save</button>
                <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
