<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Testimonial;
use App\Traits\HasPageBanner;

class TestimonialDetail extends Component
{
    use HasPageBanner;

    public $slug;
    public $testimonial;
    public $pageBanner;
    public $otherTestimonials;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->testimonial = Testimonial::where('slug', $slug)->firstOrFail();
        $this->pageBanner = $this->getPageBanner('testimonials');

        // Get other testimonials for sidebar (excluding current testimonial)
        $this->otherTestimonials = Testimonial::where('id', '!=', $this->testimonial->id)
            ->orderBy('sort_order')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.testimonial-detail');
    }
}
