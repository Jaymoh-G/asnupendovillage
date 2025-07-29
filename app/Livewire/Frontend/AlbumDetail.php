<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Album;
use App\Traits\HasPageBanner;

class AlbumDetail extends Component
{
    use HasPageBanner;

    public $slug;
    public $album;
    public $pageBanner;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->album = Album::where('slug', $slug)->with(['images'])->firstOrFail();
        $this->pageBanner = $this->getPageBanner('gallery');
    }

    public function render()
    {
        return view('livewire.frontend.album-detail');
    }
}
