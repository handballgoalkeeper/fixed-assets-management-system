@extends('template')

@section('currentPageName')
    {{ 'Employee: ' . $employees->name  }}
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ \App\Facades\AuthUserFacade::hasPermission('employees-edit') ? route(name: 'employees.update', parameters: [ 'assets' => $asset->id ]) : '' }}"
              method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="firstNameInput">First name: </label>
                <input type="text" class="form-control" id="firstNameInput" name="firstName" value="{{ $employee->first_name }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="lastNameInput">Description</label>
                <input type="text" class="form-control" id="lastNameInput" name="description"
                       value="{{ $employee->last_name }}"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="statusSelect">Status</label>
                <select class="form-control mb-3" id="statusSelect" name="isActive">
                    <option value="1" {{ $employees->is_active === 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ $employees->is_active === 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>
            <div class="float-end">
                @if(\App\Facades\AuthUserFacade::hasPermission('assets-edit'))
                    <button type="submit" class="btn btn-success">Save</button>
                @endif
                <a class="btn btn-secondary" href="{{ route('assets.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
