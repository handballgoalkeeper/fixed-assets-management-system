<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Home")]
class HomePage extends Component
{
    public function render(): View
    {
        return view('livewire.home-page');
    }
}
