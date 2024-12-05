@extends('template')

@section('currentPageName')
   Employee - Assets
@endsection

@section('content')
    @include('partials.successAlert')
    @include('partials.errorAlert')
    <a class="btn btn-secondary m-2" href="{{ route('employees.index') }}">Back</a>
    @if(!is_null($assets))
        @include('partials.pagination', ['paginator' => $assets])
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Asset type</th>
                    <th scope="col">Manufacturer</th>
                    <th scope="col">Asset model</th>
                    <th scope="col">Serial number</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($assets as $asset)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $asset->asset_type}}</td>
                        <td>{{ $asset->manufacturer->name}}</td>
                        <td>{{ $asset->asset_model}}</td>
                        <td>{{ $asset->serial_number}}</td>
                        <td>
                            <textarea class="form-control w-100" rows="1" disabled>{{$asset->description}}</textarea>
                        </td>
                        <td>{{ $asset->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', ['paginator' => $assets])
    @endif
@endsection
