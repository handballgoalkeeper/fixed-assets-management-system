<?php

namespace App\Livewire\Manufacturers\Index;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Services\ManufacturerService;
use Exception;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Page extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Url]
    public string $search = "";

    #[Url]
    public string $sortColumn = 'name';

    #[Url]
    public bool $sortAsc = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy($column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortAsc = ! $this->sortAsc;
        }
        else {
            $this->sortColumn = $column;
            $this->sortAsc = true;
        }

        $this->resetPage();
    }

    public function render(ManufacturerService $manufacturerService): View
    {
        try {
            $column = match ($this->sortColumn) {
                'name' => 'name',
                'description' => 'description',
                'status' => 'is_active'
            };

            $sortDirection = $this->sortAsc ? 'ASC' : 'DESC';


            $manufacturers = $manufacturerService->getAllManufacturersPaginated(
                perPage: 10,
                sortOrder: $sortDirection,
                sortByColumn: $column,
                searchQuery: $this->search
            );
        }
        catch(EntityNotFoundException $exception) {
            $this->addError('manufacturers', $exception->getMessage());
            return view(view: 'livewire.manufacturers.index.page', data: [
                'manufacturers' => null,
            ]);
        }
        catch (Exception) {
            $this->addError('manufacturers', ErrorMessage::UNHANDLED_EXCEPTION);
            return view(view: 'livewire.manufacturers.index.page', data: [
                'manufacturers' => null
            ]);
        }

        return view(view: 'livewire.manufacturers.index.page', data: [
            'manufacturers' => $manufacturers
        ]);
    }

    public function search() {

    }
}
