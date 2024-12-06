<?php

namespace App\Livewire\Partials;

use App\Configs\AppConfig;
use App\Configs\MainNavigationConfig;
use Illuminate\View\View;
use Livewire\Component;

class MainNavigation extends Component
{
    public array $navItems;
    public string $shortAppName;

    public function mount(): void
    {
        $this->navItems = MainNavigationConfig::getMainNavigation();
        $this->shortAppName = AppConfig::SHORT_APP_NAME;
    }

    public function render(): View
    {
        return view('livewire.partials.main-navigation');
    }
}
