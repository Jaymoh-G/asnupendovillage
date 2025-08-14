<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Traits\HasPageBanner;
use App\Models\YouTube;
use Livewire\WithPagination;

class YouTubeVideos extends Component
{
    use WithPagination;
    use HasPageBanner;

    public $pageBanner;
    public $search = '';
    public $filter = 'all'; // all, featured, recent

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('youtube-videos');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = YouTube::query();

        // Apply filters
        if ($this->filter === 'featured') {
            $query->featured();
        } elseif ($this->filter === 'recent') {
            $query->orderBy('published_at', 'desc');
        } else {
            $query->ordered();
        }

        // Apply search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('tags', 'like', '%' . $this->search . '%');
            });
        }

        $videos = $query->active()->paginate(12);

        return view('livewire.frontend.youtube-videos', [
            'videos' => $videos,
        ]);
    }
}

