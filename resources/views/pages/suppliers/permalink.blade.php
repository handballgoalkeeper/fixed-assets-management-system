@extends('template')

@section('currentPageName')
    {{ 'Supplier: ' . $supplier->name  }}
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ \App\Facades\AuthUserFacade::hasPermission('suppliers-edit') ? route(name: 'suppliers.update', parameters: [ 'supplier' => $supplier->id ]) : '' }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" value="{{ $supplier->name }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="descriptionInput">Description</label>
                <input type="text" class="form-control" id="descriptionInput" name="description"
                       value="{{ $supplier->description }}"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="pibInput">PIB</label>
                <input type="text" class="form-control" id="pibInput" name="pib" value="{{ $supplier->PIB }}"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="contactPersonInput">Contact person</label>
                <input type="text" class="form-control" id="contactPersonInput" name="contactPerson"
                       value="{{ $supplier->contact_person }}"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="statusSelect">Status</label>
                <select class="form-control mb-3" id="statusSelect" name="isActive">
                    <option value="1" {{ $supplier->is_active === 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ $supplier->is_active === 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>
            <div class="float-end">
                @if(\App\Facades\AuthUserFacade::hasPermission('suppliers-edit'))
                    <button type="submit" class="btn btn-success">Save</button>
                @endif
                <a class="btn btn-secondary" href="{{ route('suppliers.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
