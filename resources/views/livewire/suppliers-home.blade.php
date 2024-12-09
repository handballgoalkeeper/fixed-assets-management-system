<section>
    <livewire:partials.paginated-table
        :tableName="$suppliersTableName"
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
</section>
