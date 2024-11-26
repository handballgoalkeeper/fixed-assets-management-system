@extends('template')

@section('currentPageName')
    {{ 'Employee: ' . $employee->name  }}
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ \App\Facades\AuthUserFacade::hasPermission('employees-edit') ? route(name: 'employees.update', parameters: [ 'employee' => $employee->id ]) : '' }}"
              method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="firstNameInput">First name: </label>
                <input type="text" class="form-control" id="firstNameInput" name="firstName" value="{{ $employee->first_name }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="lastNameInput">Last name: </label>
                <input type="text" class="form-control" id="lastNameInput" name="lastName"
                       value="{{ $employee->last_name }}" required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="emailInput">Email: </label>
                <input type="email" class="form-control" id="emailInput" name="email"
                       value="{{ $employee->email }}" required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="statusSelect">Status</label>
                <select class="form-control mb-3" id="statusSelect" name="isActive">
                    <option value="1" {{ $employee->is_active === 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ $employee->is_active === 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>
            <div class="float-end">
                @if(\App\Facades\AuthUserFacade::hasPermission('employees-edit'))
                    <button type="submit" class="btn btn-success">Save</button>
                @endif
                <a class="btn btn-secondary" href="{{ route('employees.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
