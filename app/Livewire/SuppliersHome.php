<?php

namespace App\Livewire;

use App\Models\SupplierModel;
use Illuminate\View\View;
use Livewire\Component;

class SuppliersHome extends Component
{
    public function render(): View
    {
        return view('livewire.suppliers-home', [
            'suppliersTableName' => SupplierModel::TABLE
        ]);
    }
}
