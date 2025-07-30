<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Traits\HasPageBanner;
use App\Models\StaticPage;

class AboutUs extends Component
{
    use HasPageBanner;

    public $pageBanner;
    public $pageContent;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('about-us');
        $this->pageContent = StaticPage::getByPageName('about-us');
    }

    public function render()
    {
        return view('livewire.frontend.about-us');
    }
}
