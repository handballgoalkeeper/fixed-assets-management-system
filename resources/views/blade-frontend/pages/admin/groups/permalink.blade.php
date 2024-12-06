@extends('blade-frontend.adminPanelTemplate')

@section('currentPageName')
    Groups - Permalink
@endsection

@section('content')
    <div class="container-fluid">
        @include('blade-frontend.partials.successAlert')
        @include('blade-frontend.partials.errorAlert')
        <form
                action="{{ \App\Facades\AuthUserFacade::hasPermission('admin-groups-permissions-view') ? route('admin.groups.update', [ 'group' => $group->id ]) : ''  }}"
                method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" value="{{ $group->name }}"
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="descriptionInput">Description</label>
                <input type="text" class="form-control" id="descriptionInput" name="description"
                       value="{{ $group->description }}"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="statusSelect">Status</label>
                <select class="form-control mb-3" id="statusSelect" name="isActive">
                    <option value="1" {{ $group->is_active === 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ $group->is_active === 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>
            <div class="float-end">
                @if(\App\Facades\AuthUserFacade::hasPermission('admin-groups-permissions-view'))
                    <button type="submit" class="btn btn-success">Save</button>
                @endif
                <a class="btn btn-secondary" href="{{ route('admin.groups.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
