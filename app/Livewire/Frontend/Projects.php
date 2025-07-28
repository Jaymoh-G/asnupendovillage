<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;

class Projects extends Component
{
    use WithPagination;

    public function render()
    {
        $projects = Project::orderByDesc('updated_at')->paginate(9);
        return view('livewire.frontend.projects', [
            'projects' => $projects,
        ]);
    }
}
