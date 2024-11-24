@extends('template')

@section('currentPageName')
    {{ 'Department: ' . $department->name  }}
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ \App\Facades\AuthUserFacade::hasPermission('departments-edit') ? route(name: 'departments.update', parameters: [ 'department' => $department->id ]) : '' }}"
              method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" value="{{ $department->name }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="descriptionInput">Description</label>
                <input type="text" class="form-control" id="descriptionInput" name="description"
                       value="{{ $department->description }}"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="statusSelect">Status</label>
                <select class="form-control mb-3" id="statusSelect" name="isActive">
                    <option value="1" {{ $department->is_active === 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ $department->is_active === 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>
            <div class="float-end">
                @if(\App\Facades\AuthUserFacade::hasPermission('departments-edit'))
                    <button type="submit" class="btn btn-success">Save</button>
                @endif
                <a class="btn btn-secondary" href="{{ route('departments.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
