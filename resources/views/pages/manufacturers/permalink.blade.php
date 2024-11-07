@extends('template')

@section('currentPageName')
    {{ 'Manufacturer: ' . $manufacturer->name  }}
@endsection

@section('content')
<div class="container-fluid">
    @if(!is_null(session('error')))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route(name: 'manufacturers.update', parameters: [ 'manufacturer' => $manufacturer->id ]) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label class="form-label" for="nameInput">Name</label>
            <input type="text" class="form-control" id="nameInput" name="name" value="{{ $manufacturer->name }}" required />
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="descriptionInput">Description</label>
            <input type="text" class="form-control" id="descriptionInput" name="description" value="{{ $manufacturer->description }}" />
        </div>
        <div class="float-end">
            <button type="submit" class="btn btn-success">Save</button>
            <a class="btn btn-secondary" href="{{ route('manufacturers.index') }}">Back</a>
        </div>
    </form>
</div>
@endsection
