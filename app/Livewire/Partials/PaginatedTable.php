<?php

namespace App\Livewire\Partials;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PaginatedTable extends Component
{
    use WithPagination, WithoutUrlPagination;

// Possibly implement custom persistence across re-renders, so it can be private...
    public string $table;
    public array $columnMapping;
    public bool $hasIndexColumn;
    public bool $hasViewBtn;
    public bool $hasStatusColumn;
    public bool $hasActionsEnabled;
    public bool $hasHistoryBtn;
    public int $perPage;

    /**
     * @param string $tableName
     * @param array<string, string> $columnMapping
     * @param bool $hasIndexColumn
     * @param bool $hasViewBtn
     * @param bool $hasStatusColumn
     * @param bool $hasHistoryBtn
     * @param int $perPage
     */
    public function mount(
        string $tableName,
        array $columnMapping,
        bool $hasIndexColumn = false,
        bool $hasViewBtn = false,
        bool $hasStatusColumn = false,
        bool $hasHistoryBtn = false,
        int $perPage = 10
    ): void
    {
        if (!Schema::hasTable($tableName)) {
            $this->addError('table', "Table '$tableName' you specified does not exist.");
        }

        $this->table = $tableName;
        $this->columnMapping = $columnMapping;
        $this->hasIndexColumn = $hasIndexColumn;
        $this->hasViewBtn = $hasViewBtn;
        $this->hasStatusColumn = $hasStatusColumn;
        $this->hasHistoryBtn = $hasHistoryBtn;
        $this->perPage = $perPage;

        $this->hasActionsEnabled = in_array(needle: true, haystack: [
            $this->hasViewBtn,
            $this->hasHistoryBtn
        ],strict: true);

    }

    public function render(): View
    {
        $paginator = $this->getPaginator(perPage: $this->perPage);

        return view('livewire.partials.paginated-table', data: [
            'paginator' => $paginator
        ]);
    }

    private function getPaginator(int $perPage): LengthAwarePaginator
    {
        $builder = DB::table(table: $this->table);

        $columnsToSelect = [];

        foreach ($this->columnMapping as $tableColumnName => $dbColumnName) {
            $columnsToSelect[] = $dbColumnName . ' AS ' . $tableColumnName;
        }

        if ($this->hasStatusColumn) {
            $columnsToSelect[] = 'is_active AS Status';
        }

        $builder->select(columns: $columnsToSelect);

        return $builder->paginate(perPage: $perPage);
    }
}
