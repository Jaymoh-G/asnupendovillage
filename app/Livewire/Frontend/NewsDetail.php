<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\News as NewsModel;

class NewsDetail extends Component
{
    public $news;

    public function mount($slug)
    {
        $this->news = NewsModel::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.news-detail');
    }
}
