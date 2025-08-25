<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Event;
use App\Models\Program;
use App\Models\Project;
use App\Models\Facility;
use App\Models\Career;
use App\Models\Team;
use App\Models\StaticPage;
use App\Models\Album;
use App\Models\YouTube;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return redirect()->back();
        }

        $results = collect();

        // Search in News
        $news = News::where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->orWhere('excerpt', 'like', "%{$query}%");
        })->where('status', 'published')
            ->get()
            ->map(function ($item) {
                $item->type = 'News';
                $item->url = route('news.detail', $item->slug);
                $item->searchable_content = $this->extractSearchableContent($item->content ?? $item->excerpt);
                return $item;
            });
        $results = $results->merge($news);

        // Search in Events
        $events = Event::where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
        })->where('status', 'published')
            ->get()
            ->map(function ($item) {
                $item->type = 'Event';
                $item->url = route('event.show', $item->slug);
                $item->searchable_content = $this->extractSearchableContent($item->description);
                return $item;
            });
        $results = $results->merge($events);

        // Search in Programs
        $programs = Program::where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->orWhere('excerpt', 'like', "%{$query}%");
        })->get()
            ->map(function ($item) {
                $item->type = 'Program';
                $item->url = route('programs.detail', $item->slug);
                $item->searchable_content = $this->extractSearchableContent($item->content ?? $item->excerpt);
                return $item;
            });
        $results = $results->merge($programs);

        // Search in Projects
        $projects = Project::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->orWhere('meta_description', 'like', "%{$query}%");
        })->where('status', 'active')
            ->get()
            ->map(function ($item) {
                $item->type = 'Project';
                $item->url = route('projects.detail', $item->slug);
                $item->searchable_content = $this->extractSearchableContent($item->content ?? $item->meta_description);
                return $item;
            });
        $results = $results->merge($projects);

        // Search in Facilities
        $facilities = Facility::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->orWhere('meta_description', 'like', "%{$query}%");
        })->get()
            ->map(function ($item) {
                $item->type = 'Facility';
                $item->url = route('facilities.detail', $item->slug);
                $item->searchable_content = $this->extractSearchableContent($item->content ?? $item->meta_description);
                return $item;
            });
        $results = $results->merge($facilities);

        // Search in Careers
        $careers = Career::where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
        })->where('status', 'open')
            ->get()
            ->map(function ($item) {
                $item->type = 'Career';
                $item->url = route('careers.detail', $item->slug ?? $item->id);
                $item->searchable_content = $this->extractSearchableContent($item->description);
                return $item;
            });
        $results = $results->merge($careers);

        // Search in Team
        $team = Team::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
                ->orWhere('position', 'like', "%{$query}%")
                ->orWhere('bio', 'like', "%{$query}%");
        })->where('status', 'active')
            ->get()
            ->map(function ($item) {
                $item->type = 'Team Member';
                $item->url = route('team.detail', $item->slug);
                $item->searchable_content = $this->extractSearchableContent($item->bio);
                return $item;
            });
        $results = $results->merge($team);

        // Search in Static Pages
        $staticPages = StaticPage::where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%");
        })->where('is_active', true)
            ->get()
            ->map(function ($item) {
                $item->type = 'Page';
                // Check if there's a specific route for this page, otherwise use generic route
                $routeName = $item->page_name;
                if (in_array($routeName, ['about-us', 'founder', 'faqs', 'donate-now', 'contact-us'])) {
                    $item->url = route($routeName);
                } else {
                    $item->url = route('static.page', $item->page_name);
                }
                $item->searchable_content = $this->extractSearchableContent($item->content);
                return $item;
            });
        $results = $results->merge($staticPages);

        // Search in Albums
        $albums = Album::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
        })->where('status', 'active')
            ->get()
            ->map(function ($item) {
                $item->type = 'Album';
                $item->url = route('gallery.album', $item->slug);
                $item->searchable_content = $this->extractSearchableContent($item->description);
                return $item;
            });
        $results = $results->merge($albums);

        // Search in YouTube Videos
        $youtube = YouTube::where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
        })->where('status', 'active')
            ->get()
            ->map(function ($item) {
                $item->type = 'Video';
                $item->url = $item->video_url; // Use the actual YouTube video URL
                $item->searchable_content = $this->extractSearchableContent($item->description);
                return $item;
            });
        $results = $results->merge($youtube);

        // Sort results by relevance (simple scoring)
        $results = $results->map(function ($item) use ($query) {
            $item->relevance_score = $this->calculateRelevanceScore($item, $query);
            return $item;
        })->sortByDesc('relevance_score');

        // Paginate results
        $perPage = 15;
        $currentPage = request()->get('page', 1);
        $currentPageItems = $results->forPage($currentPage, $perPage);

        $paginatedResults = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $results->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('search.results', [
            'query' => $query,
            'results' => $paginatedResults,
            'totalResults' => $results->count()
        ]);
    }

    private function extractSearchableContent($content)
    {
        if (empty($content)) {
            return '';
        }

        // Remove HTML tags and limit length
        $cleanContent = strip_tags($content);
        return \Illuminate\Support\Str::limit($cleanContent, 200);
    }

    private function calculateRelevanceScore($item, $query)
    {
        $score = 0;
        $query = strtolower($query);

        // Title match gets highest score
        if (str_contains(strtolower($item->title ?? $item->name), $query)) {
            $score += 100;
        }

        // Content match gets medium score
        if (str_contains(strtolower($item->searchable_content), $query)) {
            $score += 50;
        }

        // Type relevance
        $priorityTypes = ['News', 'Event', 'Program', 'Project'];
        if (in_array($item->type, $priorityTypes)) {
            $score += 10;
        }

        // Recent items get slight boost
        if (isset($item->created_at) && $item->created_at->diffInDays(now()) < 30) {
            $score += 5;
        }

        return $score;
    }
}
