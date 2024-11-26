@extends('template')

@section('currentPageName')
    Locations - create
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ route(name: 'locations.create') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="aliasInput">Alias</label>
                <input type="text" class="form-control" id="aliasInput" name="alias" placeholder="Please enter alias..."
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="streetNameInput">Street name</label>
                <input type="text" class="form-control" id="streetNameInput" name="streetName"
                       placeholder="Please enter street name..." required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="streetNumberInput">Street number</label>
                <input type="text" class="form-control" id="streetNumberInput" name="streetNumber"
                       placeholder="Please enter street number..." required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="cityInput">City</label>
                <input type="text" class="form-control" id="cityInput" name="city"
                       placeholder="Please enter city..." required/>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success">Save</button>
                <a class="btn btn-secondary" href="{{ route('locations.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
