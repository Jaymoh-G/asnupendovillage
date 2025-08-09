<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;
use App\Traits\HasPageBanner;

class Events extends Component
{
    use WithPagination, HasPageBanner;

    public $pageBanner;

    public function mount()
    {
        // Get page banner for events
        $this->pageBanner = $this->getPageBanner('events');
    }

    public function render()
    {
        $events = Event::orderByDesc('start_date')->paginate(9);
        return view('livewire.frontend.events', [
            'events' => $events,
        ]);
    }
}
