<?php

namespace App\Livewire\Frontend;

use App\Models\Facility;
use App\Traits\HasPageBanner;
use Livewire\Component;
use Livewire\WithPagination;

class Facilities extends Component
{
    use WithPagination, HasPageBanner;

    public $pageBanner;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('facilities');
    }

    public function render()
    {
        $facilities = Facility::ordered()
            ->paginate(9);

        return view('livewire.frontend.facilities', [
            'facilities' => $facilities
        ]);
    }
}
