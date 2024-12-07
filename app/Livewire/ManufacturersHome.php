<?php

namespace App\Livewire;

use App\Models\ManufacturerModel;
use Illuminate\View\View;
use Livewire\Component;

class ManufacturersHome extends Component
{
    public function render(): View
    {
        return view(view: 'livewire.manufacturers-home', data: [
            'manufacturersTableName' => ManufacturerModel::TABLE,
        ]);
    }
}
