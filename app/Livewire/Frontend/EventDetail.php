<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Event;
use App\Traits\HasPageBanner;

class EventDetail extends Component
{
    use HasPageBanner;

    public $slug;
    public $event;
    public $pageBanner;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->event = Event::where('slug', $slug)->firstOrFail();
        $this->pageBanner = $this->getPageBanner('events');
    }

    public function render()
    {
        return view('livewire.frontend.event-detail');
    }
}
