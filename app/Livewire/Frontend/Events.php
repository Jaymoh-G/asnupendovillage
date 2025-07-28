<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;

class Events extends Component
{
    use WithPagination;

    public function render()
    {
        $events = Event::orderByDesc('start_date')->paginate(9);
        return view('livewire.frontend.events', [
            'events' => $events,
        ]);
    }
}
