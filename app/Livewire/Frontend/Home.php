<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Program;
use App\Models\News;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Team;

class Home extends Component
{
    public function render()
    {
        // Get the latest 6 featured programs
        $latestPrograms = Program::latestFeatured(6)->get();

        // Get the latest 6 published news articles using scopes
        $latestNews = News::published()->latestNews(6)->get();

        // Get the latest 3 active projects using scopes
        $latestProjects = Project::active()->latestProjects(3)->with('program')->get();

        // Get the latest 4 testimonials using scopes
        $latestTestimonials = Testimonial::latestTestimonials(4)->with('program')->get();

        // Get the latest 6 active team members
        $latestTeamMembers = Team::active()->latestTeamMembers(6)->get();

        return view('livewire.frontend.home', [
            'latestPrograms' => $latestPrograms,
            'latestNews' => $latestNews,
            'latestProjects' => $latestProjects,
            'latestTestimonials' => $latestTestimonials,
            'latestTeamMembers' => $latestTeamMembers
        ]);
    }
}
