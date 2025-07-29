<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Team as TeamModel;
use App\Traits\HasPageBanner;

class Team extends Component
{
    use HasPageBanner;

    public $pageBanner;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('team');
    }

    public function render()
    {
        $teams = TeamModel::active()->orderBy('sort_order')->get();

        return view('livewire.frontend.team', [
            'teams' => $teams,
        ]);
    }
}
