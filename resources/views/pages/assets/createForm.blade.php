@extends('template')

@section('currentPageName')
    Assets - create
@endsection

@section('content')
    <div class="container-fluid">
        @include('partials.successAlert')
        @include('partials.errorAlert')
        <form action="{{ route('assets.create') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="assetTypeInput">Asset type:</label>
                <input type="text" class="form-control" id="assetTypeInput" name="assetType" placeholder="Please enter asset type..."
                       required/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="manufacturerSelect">Manufacturer:</label>
                <select class="form-select" id="manufacturerSelect" name="manufacturerId">
                    <option disabled selected>Please select manufacturer...</option>
                    @foreach($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="assetModelInput">Asset model: </label>
                <input class="form-control" type="text" id="assetModelInput" name="assetModel" placeholder="Please input asset model..."
                       required />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="serialNumberInput">Serial number: </label>
                <input class="form-control" type="text" id="serialNumberInput" name="serialNumber" placeholder="Please input serial number..."/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="descriptionInput">Description: </label>
                <textarea class="form-control" id="descriptionInput" name="description" placeholder="Please input asset description..."></textarea>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success">Save</button>
                <a class="btn btn-secondary" href="{{ route('assets.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
