<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Traits\HasPageBanner;

class ContactUs extends Component
{
    use HasPageBanner;

    public $pageBanner;

    public function mount()
    {
        // Get page banner for contact-us
        $this->pageBanner = $this->getPageBanner('contact-us');
    }

    public function render()
    {
        return view('livewire.frontend.contact-us');
    }
}
