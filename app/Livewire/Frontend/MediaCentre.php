<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Event;
use App\Models\News;
use App\Models\Image;
use App\Models\Career;
use App\Models\Download;

class MediaCentre extends Component
{
    public $events;
    public $news;
    public $gallery;
    public $careers;
    public $downloads;

    public function mount()
    {
        $this->events =
            class_exists(Event::class) ? Event::orderByDesc('updated_at')->limit(3)->get() : collect();
        $this->news =
            class_exists(News::class) ? News::orderByDesc('updated_at')->limit(3)->get() : collect();
        $this->gallery =
            class_exists(Image::class) ? Image::orderByDesc('updated_at')->limit(3)->get() : collect();
        $this->careers =
            class_exists(Career::class) ? Career::orderByDesc('updated_at')->limit(3)->get() : collect();
        $this->downloads =
            class_exists(Download::class) ? Download::orderByDesc('updated_at')->limit(3)->get() : collect();
    }

    public function render()
    {
        return view('livewire.frontend.media-centre');
    }
}
