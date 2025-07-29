<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Team as TeamModel;
use App\Traits\HasPageBanner;

class TeamDetail extends Component
{
    use HasPageBanner;

    public $slug;
    public $team;
    public $pageBanner;
    public $otherTeams;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->team = TeamModel::where('slug', $slug)->firstOrFail();
        $this->pageBanner = $this->getPageBanner('team');

        // Get other team members for sidebar (excluding current team member)
        $this->otherTeams = TeamModel::where('id', '!=', $this->team->id)
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.team-detail');
    }
}
