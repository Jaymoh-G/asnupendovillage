<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Traits\HasPageBanner;
use App\Models\StaticPage;

class Founder extends Component
{
    use HasPageBanner;

    public $pageBanner;
    public $pageContent;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('founder');
        $this->pageContent = StaticPage::getByPageName('founder');
    }

    public function render()
    {
        return view('livewire.frontend.founder');
    }
}
