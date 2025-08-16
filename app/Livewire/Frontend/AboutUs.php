<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Traits\HasPageBanner;
use App\Models\StaticPage;
use App\Models\CoreValue;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Models\YouTube;

class AboutUs extends Component
{
    use HasPageBanner;

    public $pageBanner;
    public $pageContent;
    public $founderPage;
    public $coreValues;
    public $statistics;
    public $testimonials;
    public $counterStats;
    public $videoContent;
    public $teamMembers;
    public $aboutUsImages;
    public $donationPage;
    public $featuredVideo;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('about-us');
        $this->pageContent = StaticPage::getByPageName('about-us');
        $this->founderPage = StaticPage::getByPageName('founder');
        $this->donationPage = StaticPage::getByPageName('donation');
        $this->coreValues = CoreValue::getActiveOrdered();
        $this->statistics = Statistic::getActiveOrdered();
        $this->testimonials = Testimonial::featured()->latestTestimonials(4)->get();

        // Get all active statistics for the Counter Area
        $this->counterStats = Statistic::active()->ordered()->get();

        // Get video content with sort order 1
        $this->videoContent = \App\Models\HomePageContent::where('section_name', 'video-section')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->first();

        // Get featured YouTube video with sort order 1
        $this->featuredVideo = YouTube::where('sort_order', 1)
            ->where('status', 'active')
            ->first();

        // Get team members for the volunteer section
        $this->teamMembers = \App\Models\Team::active()
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        // Get about-us specific images for enhanced display
        $this->aboutUsImages = $this->getAboutUsImages();
    }

    /**
     * Get about-us specific images for enhanced display
     */
    private function getAboutUsImages(): array
    {
        $images = [];

        if ($this->pageContent) {
            // Add featured image if available
            if ($this->pageContent->featured_image) {
                $images[] = [
                    'url' => $this->pageContent->featured_image_url,
                    'alt' => 'About Us Featured',
                    'type' => 'featured'
                ];
            }

            // Add main images if available
            if ($this->pageContent->hasMultipleImages()) {
                foreach ($this->pageContent->image_urls as $index => $imageUrl) {
                    $images[] = [
                        'url' => $imageUrl,
                        'alt' => 'About Us Image ' . ($index + 1),
                        'type' => 'main'
                    ];
                }
            }

            // Add section images if available
            if ($this->pageContent->hasSection1Images()) {
                foreach ($this->pageContent->section1_image_urls as $index => $imageUrl) {
                    $images[] = [
                        'url' => $imageUrl,
                        'alt' => 'About Us Section 1 Image ' . ($index + 1),
                        'type' => 'section1'
                    ];
                }
            }
        }

        return $images;
    }

    public function render()
    {
        return view('livewire.frontend.about-us');
    }
}
