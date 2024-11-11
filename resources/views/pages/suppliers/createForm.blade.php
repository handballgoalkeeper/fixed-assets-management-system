@extends('template')

@section('currentPageName')
    Supplier - create
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ route(name: 'suppliers.create') }}" method="POST">
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
            <div class="form-group mb-3">
                <label class="form-label" for="pibInput">PIB</label>
                <input type="text" class="form-control" id="pibInput" name="pib" placeholder="Please enter pib..."/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="contactPersonInput">Contact person</label>
                <input type="text" class="form-control" id="contactPersonInput" name="contactPerson"
                       placeholder="Please enter contact person full name..."/>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success">Save</button>
                <a class="btn btn-secondary" href="{{ route('suppliers.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
