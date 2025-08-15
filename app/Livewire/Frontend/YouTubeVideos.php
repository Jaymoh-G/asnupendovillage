<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Traits\HasPageBanner;
use App\Models\YouTube;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

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
                    ->orWhere('description', 'like', '%' . $this->search . '%');

                // Only search in tags if the search term is not empty and valid
                if (!empty(trim($this->search))) {
                    try {
                        $q->orWhereJsonContains('tags', trim($this->search));
                    } catch (\Exception $e) {
                        // Fallback to simple LIKE search if JSON search fails
                        $q->orWhere('tags', 'like', '%' . trim($this->search) . '%');
                    }
                }
            });
        }

        $videos = $query->active()->paginate(12);

        // Debug: Check the first video's tags
        if (config('app.debug') && $videos->count() > 0) {
            $firstVideo = $videos->first();
            Log::info("First video tags debug:", [
                'video_id' => $firstVideo->id,
                'tags_type' => gettype($firstVideo->tags),
                'tags_value' => $firstVideo->tags,
                'raw_tags' => $firstVideo->getRawOriginal('tags'),
                'raw_tags_type' => gettype($firstVideo->getRawOriginal('tags'))
            ]);
        }

        return view('livewire.frontend.youtube-videos', [
            'videos' => $videos,
        ]);
    }
}
