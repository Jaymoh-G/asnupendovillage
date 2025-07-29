<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Testimonial;
use App\Traits\HasPageBanner;
use Livewire\WithPagination;

class Testimonials extends Component
{
    use WithPagination;
    use HasPageBanner;

    public $pageBanner;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('testimonials');
    }

    public function render()
    {
        $testimonials = Testimonial::orderBy('sort_order')->paginate(6);

        return view('livewire.frontend.testimonials', [
            'testimonials' => $testimonials,
        ]);
    }
}
