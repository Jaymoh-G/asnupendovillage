<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Facility;
use App\Traits\HasPageBanner;

class FacilityDetail extends Component
{
    use HasPageBanner;

    public $slug;
    public $facility;
    public $pageBanner;
    public $otherFacilities;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->facility = Facility::where('slug', $slug)->firstOrFail();
        $this->pageBanner = $this->getPageBanner('facilities');

        // Get other facilities for sidebar (excluding current facility)
        $this->otherFacilities = Facility::where('id', '!=', $this->facility->id)
            ->where('status', 'active')
            ->with('program')
            ->orderBy('name')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.facility-detail');
    }
}
