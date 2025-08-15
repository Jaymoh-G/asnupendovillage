<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Program;
use App\Traits\HasPageBanner;

class Programs extends Component
{
    use WithPagination, HasPageBanner;

    public $pageBanner;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('programs');
    }

    public function render()
    {
        $programs = Program::ordered()->paginate(9);

        return view('livewire.frontend.programs', [
            'programs' => $programs,
        ]);
    }
}
