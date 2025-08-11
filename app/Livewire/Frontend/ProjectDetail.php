<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Project;
use App\Traits\HasPageBanner;

class ProjectDetail extends Component
{
    use HasPageBanner;

    public $slug;
    public $project;
    public $pageBanner;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->project = Project::where('slug', $slug)->firstOrFail();
        $this->pageBanner = $this->getPageBanner('projects');
    }

    public function render()
    {
        return view('livewire.frontend.project-detail');
    }
}
