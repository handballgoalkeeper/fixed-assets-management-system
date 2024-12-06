@extends('blade-frontend.template')

@section('currentPageName')
    Employees - create
@endsection

@section('content')
    <div class="container-fluid">
        @include('blade-frontend.partials.successAlert')
        @include('blade-frontend.partials.errorAlert')
        <form action="{{ route(name: 'employees.create') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="firstNameInput">First name: </label>
                <input type="text" class="form-control" id="firstNameInput" name="firstName"
                       placeholder="Please enter first name..."
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="lastNameInput">Last name: </label>
                <input type="text" class="form-control" id="lastNameInput" name="lastName"
                       placeholder="Please enter last name..."
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="emailInput">Email: </label>
                <input type="email" class="form-control" id="emailInput" name="email"
                       placeholder="Please enter email..."
                       required/>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success">Save</button>
                <a class="btn btn-secondary" href="{{ route('employees.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
