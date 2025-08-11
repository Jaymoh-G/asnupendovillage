<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Career;

class Careers extends Component
{
    public $careers;
    public $career;

    public function mount()
    {
        $this->careers = Career::where('status', 'open')
            ->where(function($query) {
                $query->whereNull('application_deadline')
                      ->orWhere('application_deadline', '>', now());
            })
            ->orderByDesc('updated_at')
            ->get();
    }

    public function show($id)
    {
        $this->career = \App\Models\Career::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.frontend.careers');
    }
}
