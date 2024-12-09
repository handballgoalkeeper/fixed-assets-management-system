<section>
        <div class="d-flex justify-content-center mt-4">
            {{ $paginator->links() }}
        </div>
        <div class="container-flow table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    @if($hasIndexColumn)
                        <th scope="col">#</th>
                    @endif
                    @foreach($columnMapping as $columnName => $_)
                        <th scope="col">{{ $columnName }}</th>
                    @endforeach
                    @if($hasStatusColumn)
                        <th scope="col">Status</th>
                    @endif
                    @if($hasActionsEnabled)
                        <th scope="col" class="text-center">Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                    @foreach($paginator as $row)
                        <tr>
                            @if($hasIndexColumn)
                                <th scope="row">{{ $loop->iteration }}</th>
                            @endif
                            @foreach($columnMapping as $columnName => $_)
                                <td>{{ $row->{$columnName} }}</td>
                            @endforeach
                            @if($hasStatusColumn)
                                @if( $row->Status === 1 )
                                    <td class="text-success">Active</td>
                                @else
                                    <td class="text-danger">Inactive</td>
                                @endif
                            @endif
                            @if($hasActionsEnabled)
                                <td class="text-center">
                                    @if($hasViewBtn)
                                        <a href="#" class="btn btn-outline-primary">View</a>
                                    @endif
                                    @if($hasHistoryBtn)
                                        <a href="#" class="btn btn-outline-secondary">History</a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $paginator->links() }}
        </div>
</section>
