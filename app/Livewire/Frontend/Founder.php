<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Traits\HasPageBanner;

class Founder extends Component
{
    use HasPageBanner;

    public $pageBanner;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('founder');
    }

    public function render()
    {
        return view('livewire.frontend.founder');
    }
}
