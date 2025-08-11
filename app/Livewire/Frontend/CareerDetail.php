<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Career;
use Illuminate\Support\Facades\Mail;
use App\Traits\HasPageBanner;

class CareerDetail extends Component
{
    use HasPageBanner;

    public $career;
    public $pageBanner;
    public $applicantName;
    public $applicantEmail;
    public $applicantMessage;
    public $successMessage;

    public function mount($slug)
    {
        // Try to find by slug first, then by ID if slug is numeric
        if (is_numeric($slug)) {
            $this->career = Career::findOrFail($slug);
        } else {
            $this->career = Career::where('slug', $slug)->firstOrFail();
        }

        // Get page banner for careers
        $this->pageBanner = $this->getPageBanner('careers');
    }

    public function applyNow()
    {
        $this->validate([
            'applicantName' => 'required|string|max:255',
            'applicantEmail' => 'required|email',
            'applicantMessage' => 'required|string',
        ]);

        Mail::raw(
            "Application for: {$this->career->title}\n\nName: {$this->applicantName}\nEmail: {$this->applicantEmail}\nMessage: {$this->applicantMessage}",
            function ($message) {
                $message->to($this->career->contact_email)
                    ->subject('New Career Application: ' . $this->career->title);
            }
        );

        $this->successMessage = 'Your application has been sent!';
        $this->reset(['applicantName', 'applicantEmail', 'applicantMessage']);
    }

    public function render()
    {
        return view('livewire.frontend.career-detail');
    }
}
