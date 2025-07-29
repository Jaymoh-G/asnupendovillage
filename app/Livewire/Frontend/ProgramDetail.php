<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Program;
use App\Traits\HasPageBanner;

class ProgramDetail extends Component
{
    use HasPageBanner;

    public $slug;
    public $program;
    public $pageBanner;
    public $otherPrograms;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->program = Program::where('slug', $slug)->firstOrFail();
        $this->pageBanner = $this->getPageBanner('programs');

        // Get other programs for sidebar (excluding current program)
        $this->otherPrograms = Program::where('id', '!=', $this->program->id)
            ->orderBy('title')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.program-detail');
    }
}
