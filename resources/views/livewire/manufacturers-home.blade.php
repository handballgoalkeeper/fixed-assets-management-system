<div>
    <livewire:partials.paginated-table
        :tableName="$manufacturersTableName"
        :columnMapping="[
            'Name' => 'name',
            'Description' => 'description'
        ]"
        :hasIndexColumn="true"
        :hasViewBtn="true"
        :hasStatusColumn="true"
        :hasHistoryBtn="true"
        :perPage="5"
    />
</div>
