<?php

namespace App\Livewire\Frontend;

use App\Models\HomeSlider;
use Livewire\Component;

class HomeSliderComponent extends Component
{
    public $sliders;
    public $featuredOnly = false;

    public function mount($featuredOnly = false)
    {
        $this->featuredOnly = $featuredOnly;
        $this->loadSliders();
    }

    public function loadSliders()
    {
        if ($this->featuredOnly) {
            $this->sliders = HomeSlider::getFeaturedSliders();
        } else {
            $this->sliders = HomeSlider::getActiveSliders();
        }
    }

    public function render()
    {
        return view('livewire.frontend.home-slider');
    }
}
