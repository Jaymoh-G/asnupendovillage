<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Event;
use App\Models\News;
use App\Models\Album;
use App\Models\Career;
use App\Models\Download;
use App\Traits\HasPageBanner;

class MediaCentre extends Component
{
    use HasPageBanner;

    public $events;
    public $news;
    public $albums;
    public $careers;
    public $downloads;
    public $pageBanner;

    public function mount()
    {
        $this->events =
            class_exists(Event::class) ? Event::orderByDesc('updated_at')->limit(3)->get() : collect();
        $this->news =
            class_exists(News::class) ? News::orderByDesc('updated_at')->limit(3)->get() : collect();
        $this->albums =
            class_exists(Album::class) ? Album::active()->with(['images'])->orderByDesc('updated_at')->limit(3)->get() : collect();
        $this->careers =
            class_exists(Career::class) ? Career::orderByDesc('updated_at')->limit(3)->get() : collect();
        $this->downloads =
            class_exists(Download::class) ? Download::orderByDesc('updated_at')->limit(3)->get() : collect();

        // Get page banner for media-centre
        $this->pageBanner = $this->getPageBanner('media-centre');
    }

    public function render()
    {
        return view('livewire.frontend.media-centre');
    }
}
