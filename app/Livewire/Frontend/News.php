<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News as NewsModel;
use App\Traits\HasPageBanner;

class News extends Component
{
    use WithPagination, HasPageBanner;

    public $pageBanner;

    public function mount()
    {
        // Get page banner for news
        $this->pageBanner = $this->getPageBanner('news');
    }

    public function render()
    {
        $news = NewsModel::published()->orderByDesc('published_at')->paginate(9);
        return view('livewire.frontend.news', [
            'news' => $news,
        ]);
    }
}
