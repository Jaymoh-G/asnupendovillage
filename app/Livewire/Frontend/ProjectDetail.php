<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Project;

class ProjectDetail extends Component
{
    public $project;

    public function mount($slug)
    {
        $this->project = Project::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.project-detail');
    }
}
