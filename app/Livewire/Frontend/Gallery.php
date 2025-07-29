<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Album;
use App\Traits\HasPageBanner;
use Livewire\WithPagination;

class Gallery extends Component
{
    use HasPageBanner;
    use WithPagination;

    public $pageBanner;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('gallery');
    }

    public function render()
    {
        $albums = Album::active()
            ->orderBy('name', 'asc')
            ->with(['images', 'coverImage'])
            ->paginate(12);

        return view('livewire.frontend.gallery', [
            'albums' => $albums,
        ]);
    }
}
