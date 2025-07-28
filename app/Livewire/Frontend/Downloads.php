<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Download;
use App\Models\Program;
use App\Traits\HasPageBanner;
use Livewire\WithPagination;

class Downloads extends Component
{
    use WithPagination, HasPageBanner;

    public $programs;
    public $selectedProgram = '';
    public $pageBanner;

    public function mount($programId = null)
    {
        $this->programs = Program::orderBy('title')->get();
        if ($programId) {
            $this->selectedProgram = $programId;
        }

        // Get page banner for downloads
        $this->pageBanner = $this->getPageBanner('downloads');
    }

    public function filterByProgram($programId = null)
    {
        $this->selectedProgram = $programId ?? '';
        $this->resetPage();
    }

    public function render()
    {
        $query = Download::orderByDesc('updated_at');
        if ($this->selectedProgram) {
            $query->where('program_id', $this->selectedProgram);
        }
        $downloads = $query->paginate(12);
        return view('livewire.frontend.downloads', [
            'downloads' => $downloads,
            'programs' => $this->programs,
            'selectedProgram' => $this->selectedProgram,
            'pageBanner' => $this->pageBanner,
        ]);
    }
}
