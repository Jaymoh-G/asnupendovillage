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
        $this->careers = Career::orderByRaw("
            CASE
                WHEN status = 'open' AND (application_deadline IS NULL OR application_deadline > NOW()) THEN 1
                WHEN status = 'open' AND application_deadline <= NOW() THEN 2
                WHEN status = 'closed' THEN 3
                ELSE 4
            END
        ")->orderByDesc('updated_at')->get();
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
