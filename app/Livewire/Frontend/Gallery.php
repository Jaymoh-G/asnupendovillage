<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Album;

class Gallery extends Component
{
    public function render()
    {
        $albums = Album::active()
            ->orderBy('name', 'asc')
            ->with(['images', 'coverImage'])
            ->get();

        return view('livewire.frontend.gallery', [
            'albums' => $albums,
        ]);
    }
}
