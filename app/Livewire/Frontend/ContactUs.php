<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Traits\HasPageBanner;
use App\Models\StaticPage;

class ContactUs extends Component
{
    use HasPageBanner;

    public $pageBanner;
    public $pageContent;

    public function mount()
    {
        // Get page banner for contact-us
        $this->pageBanner = $this->getPageBanner('contact-us');

        // Get static page content for contact-us
        $this->pageContent = StaticPage::getByPageName('contact-us');
    }

    public function render()
    {
        return view('livewire.frontend.contact-us');
    }
}
