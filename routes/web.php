<?php

use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\Faqs;
use App\Livewire\Frontend\MediaCentre;
use App\Livewire\Frontend\Team;
use App\Livewire\Frontend\DonationPage;
use App\Livewire\Frontend\ContactUs;
use App\Livewire\Frontend\Gallery;
use App\Livewire\Frontend\Testimonials;
use App\Livewire\Frontend\News;
use Illuminate\Support\Facades\Route;
use App\Livewire\Frontend\Downloads;
use App\Livewire\Frontend\Careers;
use App\Livewire\Frontend\Projects;
use App\Livewire\Frontend\Events;
use App\Livewire\Frontend\Facilities;
use App\Livewire\Frontend\YouTubeVideos;
use App\Models\Program;

Route::get('/', Home::class)->name('home');

// Search functionality
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');


// about us

Route::get('/about-us', function () {
    return view('about-us-page');
})->name('about-us');
// founder
Route::get('/founder', function () {
    return view('founder-page');
})->name('founder');
// faqs
Route::get('/faqs', Faqs::class)->name('faqs');
// media centre
Route::get('/media-centre', MediaCentre::class)->name('media-centre');
// team
Route::get('/team', function () {
    return view('team-page');
})->name('team');
// team detail
Route::get('/team/{slug}', function ($slug) {
    return view('team-detail-page', ['slug' => $slug]);
})->name('team.detail');
// donate now
Route::get('/donate-now', function () {
    return view('donation-page');
})->name('donate-now');

// thank you page
Route::get('/thank-you', function () {
    return view('thank-you');
})->name('thank-you');
// contact us
Route::get('/contact-us', ContactUs::class)->name('contact-us');
Route::post('/contact/submit', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// donation request (send details via email)
Route::post('/donation/request', [App\Http\Controllers\DonationRequestController::class, 'submit'])->name('donation.request');

// Generic static page route for other static pages
Route::get('/page/{pageName}', function ($pageName) {
    $page = \App\Models\StaticPage::where('page_name', $pageName)->where('is_active', true)->first();

    if (!$page) {
        abort(404);
    }

    return view('static-page', ['page' => $page]);
})->name('static.page');
// gallery
Route::get('/photo-gallery', Gallery::class)->name('gallery');
// album detail
Route::get('/gallery/{slug}', function ($slug) {
    return view('album-detail-page', ['slug' => $slug]);
})->name('gallery.album');
// youtube videos
Route::get('/youtube-gallery', YouTubeVideos::class)->name('youtube-gallery');
// testimonials
Route::get('/testimonials', function () {
    return view('testimonials-page');
})->name('testimonials');
// testimonial detail
Route::get('/testimonials/{slug}', function ($slug) {
    return view('testimonial-detail-page', ['slug' => $slug]);
})->name('testimonials.detail');
// news
Route::get('/news', function () {
    return view('news-page');
})->name('news');
// news detail
Route::get('/news/{slug}', function ($slug) {
    return view('news-detail-page', ['slug' => $slug]);
})->name('news.detail');
// monthly reports (formerly downloads)
Route::get('/monthly-reports', function () {
    return view('downloads-page');
})->name('downloads');

// careers
Route::get('/careers', function () {
    return view('careers-page');
})->name('careers');
// career detail
Route::get('/careers/{slug}', function ($slug) {
    return view('career-detail-page', ['slug' => $slug]);
})->name('careers.detail')->where('slug', '.*');

// projects
Route::get('/projects', function () {
    return view('projects-page');
})->name('projects');
// project detail
Route::get('/projects/{slug}', function ($slug) {
    return view('project-detail-page', ['slug' => $slug]);
})->name('projects.detail');

// events
Route::get('/events', function () {
    return view('events-page');
})->name('events');
// event detail
Route::get('/events/{slug}', function ($slug) {
    return view('event-detail-page', ['slug' => $slug]);
})->name('event.show');

// facilities
Route::get('/facilities', function () {
    return view('facilities-page');
})->name('facilities');
// facility detail
Route::get('/facilities/{slug}', function ($slug) {
    return view('facility-detail-page', ['slug' => $slug]);
})->name('facilities.detail');

// programs
Route::get('/programs', function () {
    return view('programs-page');
})->name('programs');
// program detail
Route::get('/programs/{slug}', function ($slug) {
    return view('program-detail-page', ['slug' => $slug]);
})->name('programs.detail');

// Image management routes
Route::delete('/admin/images/{imageId}/remove', [App\Http\Controllers\ImageController::class, 'removeImage'])
    ->name('admin.remove-image')
    ->middleware(['auth', 'web']);

// Custom route for deleting images from news articles
Route::post('/admin/news/{newsId}/delete-image/{imageId}', [App\Filament\Resources\NewsResource\Pages\EditNews::class, 'deleteImage'])
    ->name('admin.news.delete-image')
    ->middleware(['auth', 'web']);

// Custom route for updating image captions
Route::post('/admin/images/{imageId}/update-caption', [App\Http\Controllers\ImageController::class, 'updateCaption'])
    ->name('admin.images.update-caption')
    ->middleware(['auth', 'web']);

// Custom route for deleting images from events
Route::post('/admin/events/{eventId}/delete-image/{imageId}', [App\Filament\Resources\EventsResource\Pages\EditEvents::class, 'deleteImage'])
    ->name('admin.events.delete-image')
    ->middleware(['auth', 'web']);

// Custom route for deleting images from facilities
Route::post('/admin/facilities/{facilityId}/delete-image/{imageId}', [App\Filament\Resources\FacilityResource\Pages\EditFacility::class, 'deleteImage'])
    ->name('admin.facilities.delete-image')
    ->middleware(['auth', 'web']);

// Custom route for deleting images from projects
Route::post('/admin/projects/{projectId}/delete-image/{imageId}', [App\Filament\Resources\ProjectResource\Pages\EditProject::class, 'deleteImage'])
    ->name('admin.projects.delete-image')
    ->middleware(['auth', 'web']);

// Custom route for deleting images from programs
Route::post('/admin/programs/{programId}/delete-image/{imageId}', [App\Filament\Resources\ProgramResource\Pages\EditProgram::class, 'deleteImage'])
    ->name('admin.programs.delete-image')
    ->middleware(['auth', 'web']);

// Custom route for deleting images from testimonials
Route::post('/admin/testimonials/{testimonialId}/delete-image/{imageId}', [App\Filament\Resources\TestimonialResource\Pages\EditTestimonial::class, 'deleteImage'])
    ->name('admin.testimonials.delete-image')
    ->middleware(['auth', 'web']);

Route::get('/monthly-reports/program/{program:slug}', function (Program $program) {
    return view('downloads-page', ['programId' => $program->id]);
})->name('downloads.by-program');

// M-Pesa routes
Route::post('/mpesa/callback', [App\Http\Controllers\MpesaController::class, 'callback'])->name('mpesa.callback');
Route::post('/mpesa/check-status', [App\Http\Controllers\MpesaController::class, 'checkStatus'])->name('mpesa.check-status');
// routes/web.php
Route::get('/whoami', function () {
    return [
        'user' => auth()->user(),
        'roles' => auth()->user()?->roles->pluck('name'),
        'session' => session()->all(),
    ];
});
