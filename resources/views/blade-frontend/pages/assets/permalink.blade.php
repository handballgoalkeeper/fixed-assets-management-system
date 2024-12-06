@extends('blade-frontend.template')

@section('currentPageName')
    {{ 'Asset: ' . $asset->id }}
@endsection

@section('content')
    <div class="container-fluid">
        @include('blade-frontend.partials.successAlert')
        @include('blade-frontend.partials.errorAlert')

        <form
                action="{{ \App\Facades\AuthUserFacade::hasPermission('assets-edit') ? route(name: 'assets.update', parameters: [ 'asset' => $asset->id ]) : '' }}"
                method="POST">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="assetTypeInput">Asset type: </label>
                            <input type="text" class="form-control" id="assetTypeInput" name="assetType"
                                   value="{{ $asset->asset_type }}"
                                   required/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="manufacturerIdSelect">Manufacturer: </label>
                            <select class="form-select" id="manufacturerIdSelect" name="manufacturerId">
                                @foreach($manufacturers as $manufacturer)
                                    <option
                                            value="{{ $manufacturer->id }}" {{ $asset->manufacturer->id === $manufacturer->id ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="assetModelInput">Asset model: </label>
                            <input class="form-control" type="text" id="assetModelInput" name="assetModel"
                                   value="{{ $asset->asset_model }}" required/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="serialNumberInput">Serial number: </label>
                            <input class="form-control" type="text" id="serialNumberInput" name="serialNumber"
                                   value="{{ $asset->serial_number }}"/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="descriptionTextarea">Description: </label>
                            <textarea class="form-control" id="descriptionTextarea" name="description"
                                      rows="1">{{ $asset->description }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="employeeSelect">Assigned to employee: </label>
                            <select class="form-select" id="employeeSelect" name="employeeId">
                                <option value="" selected>Please select employee...</option>
                                @foreach($employees as $employee)
                                    <option
                                            value="{{ $employee->id }}" {{ $asset->assetDetails->assigned_to === $employee->id ? 'selected' : '' }}>
                                        {{ $employee->first_name }} {{ $employee->last_name }} {{ !is_null($employee->department) ? '| ' . $employee->department->name : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="fixedAssetNumberInput">Fixed asset number: </label>
                            <input type="text" class="form-control" id="fixedAssetNumberInput" name="fixedAssetNumber"
                                   value="{{ $asset->assetDetails->fixed_asset_number }}"/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="itNumberInput">IT Number: </label>
                            <input type="text" class="form-control" id="itNumberInput" name="itNumber"
                                   value="{{ $asset->assetDetails->it_number }}"/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="supplierSelect">Suppliers: </label>
                            <select class="form-select" id="supplierSelect" name="supplierId">
                                <option value="" selected>Please select supplier...</option>
                                @foreach($suppliers as $supplier)
                                    <option
                                            value="{{ $supplier->id }}" {{ (!is_null($asset->assetDetails->supplier) and $asset->assetDetails->supplier->id === $supplier->id) ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="storageTypeSelect">Storage type: </label>
                                        <select class="form-select" id="storageTypeSelect" name="storageType">
                                            <option value="" selected>Please select storage type...</option>
                                            @foreach(\App\Enums\StorageType::cases() as $storageType)
                                                <option
                                                        value="{{ $storageType->value }}" {{ (!is_null($asset->assetDetails->storage_type) and $asset->assetDetails->storage_type === $storageType->value) ? 'selected' : '' }}>{{ $storageType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="storageCapacityInput">Storage capacity: </label>
                                        <input type="number" min="0" class="form-control" id="storageCapacityInput"
                                               name="storageCapacity"
                                               value="{{ $asset->assetDetails->storage_capacity }}"/>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="storageCapacityUnitsOfMeasureSelect">Storage
                                            capacity unit of
                                            measure: </label>
                                        <select class="form-select" id="storageCapacityUnitsOfMeasureSelect"
                                                name="storageCapacityUnitsOfMeasure">
                                            <option value="" selected>Please select storage type...</option>
                                            @foreach(\App\Enums\CapacityUnitOfMeasure::cases() as $storageCapacityUnitOfMeasure)
                                                <option
                                                        value="{{ $storageCapacityUnitOfMeasure->value }}" {{ (!is_null($asset->assetDetails->storage_capacity_units_of_measure) and $asset->assetDetails->storage_capacity_units_of_measure === $storageCapacityUnitOfMeasure->value) ? 'selected' : '' }}>{{ $storageCapacityUnitOfMeasure->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="ramGenerationSelect">Ram generation: </label>
                                        <select class="form-select" id="ramGenerationSelect" name="ramGeneration">
                                            <option value="" selected>Please select storage type...</option>
                                            @foreach(\App\Enums\RamGeneration::cases() as $ramGeneration)
                                                <option
                                                        value="{{ $ramGeneration->value }}" {{ (!is_null($asset->assetDetails->ram_generation) && $asset->assetDetails->ram_generation === $ramGeneration->value) ? 'selected' : '' }}>{{ $ramGeneration->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="ramCapacityInput">Ram capacity: </label>
                                        <input type="number" min="0" class="form-control" id="ramCapacityInput"
                                               name="ramCapacity" value="{{ $asset->assetDetails->ram_capacity }}"/>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="ramCapacityUnitsOfMeasureSelect">RAM capacity
                                            unit of measure: </label>
                                        <select class="form-select" id="ramCapacityUnitsOfMeasureSelect"
                                                name="ramCapacityUnitsOfMeasure">
                                            <option value="" selected>Please select storage type...</option>
                                            @foreach(\App\Enums\CapacityUnitOfMeasure::cases() as $storageCapacityUnitOfMeasure)
                                                <option
                                                        value="{{ $storageCapacityUnitOfMeasure->value }}" {{ (!is_null($asset->assetDetails->storage_capacity_units_of_measure) && $asset->assetDetails->storage_capacity_units_of_measure === $storageCapacityUnitOfMeasure->value) ? 'selected' : '' }}>
                                                    {{ $storageCapacityUnitOfMeasure->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="locationSelect">Location: </label>
                            <select class="form-select" id="locationSelect" name="locationId">
                                <option value="" selected>Please select location...</option>
                                @foreach($locations as $location)
                                    <option
                                            value="{{ $location->id }}" {{ (!is_null($asset->assetDetails->location) and $asset->assetDetails->location->id === $location->id) ? 'selected' : '' }}>
                                        {{ $location->alias }}
                                        | {{ $location->street_name }} {{ $location->street_number }}
                                        , {{ $location->city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="float-end">
                            @if(\App\Facades\AuthUserFacade::hasPermission('assets-edit'))
                                <button type="submit" class="btn btn-success">Save</button>
                            @endif
                            <a class="btn btn-secondary" href="{{ route('assets.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
