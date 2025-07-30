<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News as NewsModel;

class News extends Component
{
    use WithPagination;

    public function render()
    {
        $news = NewsModel::published()->orderByDesc('published_at')->paginate(9);
        return view('livewire.frontend.news', [
            'news' => $news,
        ]);
    }
}
