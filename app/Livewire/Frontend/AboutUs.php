<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Traits\HasPageBanner;

class AboutUs extends Component
{
    use HasPageBanner;

    public $pageBanner;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('about-us');
    }

    public function render()
    {
        return view('livewire.frontend.about-us');
    }
}
