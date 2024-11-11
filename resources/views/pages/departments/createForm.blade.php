@extends('template')

@section('currentPageName')
    Departments - create
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ route('departments.create') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" placeholder="Please enter name..."
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="descriptionInput">Description</label>
                <input type="text" class="form-control" id="descriptionInput" name="description"
                       placeholder="Please enter description..."/>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success">Save</button>
                <a class="btn btn-secondary" href="{{ route('departments.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
