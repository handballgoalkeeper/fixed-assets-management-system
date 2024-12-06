@extends('blade-frontend.template')

@section('currentPageName')
    Assets
@endsection

@section('content')
    @include('blade-frontend.partials.errorAlert')
    @include('blade-frontend.partials.successAlert')
    @if(\App\Facades\AuthUserFacade::hasPermission('assets-create'))
        <a class="btn btn-primary m-2" href="{{ route('assets.view.create') }}">
            Create asset
        </a>
    @endif
    @if(!is_null($assets))
        @include('blade-frontend.partials.pagination', ['paginator' => $assets])
        <div class="container-flow table-responsive">
            <table class="table table-sm table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Asset type</th>
                    <th scope="col">Manufacturer</th>
                    <th scope="col">Asset model</th>
                    <th scope="col">Serial number</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($assets as $asset)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $asset->asset_type }}</td>
                        <td>{{ $asset->manufacturer->name }}</td>
                        <td>{{ $asset->asset_model }}</td>
                        <td>{{ $asset->serial_number }}</td>
                        <td>
                            <a href="{{ route(name: 'assets.permalink', parameters: [ 'asset' => $asset->id] ) }}"
                               class="btn btn-outline-primary">
                                View
                            </a>
                            {{--                            @if(\App\Facades\AuthUserFacade::hasPermission('assets-history'))--}}
                            {{--                                <a href="{{ route(name: 'assets.history', parameters: [ 'department' => $asset->id] ) }}" class="btn btn-outline-secondary">--}}
                            {{--                                    History--}}
                            {{--                                </a>--}}
                            {{--                            @endif--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('blade-frontend.partials.pagination', ['paginator' => $assets])
    @endif
@endsection
