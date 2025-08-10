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
    public $relatedEvents;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->event = Event::where('slug', $slug)->firstOrFail();
        $this->pageBanner = $this->getPageBanner('events');

        // Get related events (upcoming and past, excluding current event)
        $this->relatedEvents = Event::where('id', '!=', $this->event->id)
            ->where('status', 'published')
            ->orderBy('start_date', 'desc')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.event-detail');
    }
}
