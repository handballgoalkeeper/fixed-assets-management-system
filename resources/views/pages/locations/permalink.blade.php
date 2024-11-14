@extends('template')

@section('currentPageName')
    {{ 'Location: ' . $location->name  }}
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ route(name: 'locations.update', parameters: [ 'location' => $location->id ]) }}"
              method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="aliasInput">Name</label>
                <input type="text" class="form-control" id="aliasInput" name="alias" value="{{ $location->alias }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="streetNameInput">Name</label>
                <input type="text" class="form-control" id="streetNameInput" name="streetName" value="{{ $location->street_name }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="streetNumberInput">Name</label>
                <input type="text" class="form-control" id="streetNumberInput" name="streetNumber" value="{{ $location->street_number }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="cityInput">Name</label>
                <input type="text" class="form-control" id="cityInput" name="city" value="{{ $location->city }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="statusSelect">Status</label>
                <select class="form-control mb-3" id="statusSelect" name="isActive">
                    <option value="1" {{ $location->is_active === 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ $location->is_active === 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success">Save</button>
                <a class="btn btn-secondary" href="{{ route('locations.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
