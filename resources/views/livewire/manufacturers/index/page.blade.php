<section>
    <div class="d-flex w-25">
        <input
            wire:model.live.debounce.250ms="search"
            class="form-control form-control-md m-2 border border-primary-subtle"
            type="search"
            placeholder="Search..."
        >
    </div>
    <div class="container-flow table-responsive position-relative">
        <table class="table table-striped table-responsive-sm" wire:key="{{ uniqid() }}">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <x-manufacturers.index.sortable column="name" :sortCol="$sortColumn" :sortAsc="$sortAsc">
                            Name
                        </x-manufacturers.index.sortable>
                    <th scope="col">
                        <x-manufacturers.index.sortable column="description" :sortCol="$sortColumn" :sortAsc="$sortAsc">
                            Description
                        </x-manufacturers.index.sortable>
                    </th>
                    <th scope="col">
                        <x-manufacturers.index.sortable column="status" :sortCol="$sortColumn" :sortAsc="$sortAsc">
                            Status
                        </x-manufacturers.index.sortable>
                    </th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            @if(!is_null($manufacturers))
                <tbody>
                @foreach($manufacturers as $manufacturer)
                    <tr wire:key="{{ $manufacturer->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $manufacturer->name }}</td>
                        <td>{{ $manufacturer->description }}</td>
                        @if( $manufacturer->is_active === 1 )
                            <td class="text-success">Active</td>
                        @else
                            <td class="text-danger">Inactive</td>
                        @endif
                        <td>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @endif
        </table>
        <div wire:loading class="position-absolute bg-white top-0 left-0 w-100 h-100 opacity-50"></div>
        <div class="position-absolute top-0 left-0 w-100 h-100 d-flex justify-content-center align-items-center z-n1">
            <x-icon.bootstrap-spinner />
        </div>
    </div>
    @if(!is_null($manufacturers))
        {{ $manufacturers->links() }}
    @endif
</section>
