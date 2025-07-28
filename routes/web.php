<?php

use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\Faqs;
use App\Livewire\Frontend\MediaCentre;
use App\Livewire\Frontend\Team;
use App\Livewire\Frontend\DonateNow;
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
use App\Models\Program;

Route::get('/', Home::class)->name('home');
// faqs
Route::get('/faqs', Faqs::class)->name('faqs');
// media centre
Route::get('/media-centre', MediaCentre::class)->name('media-centre');
// team
Route::get('/team', Team::class)->name('team');
// donate now
Route::get('/donate-now', DonateNow::class)->name('donate-now');
// contact us
Route::get('/contact-us', ContactUs::class)->name('contact-us');
// gallery
Route::get('/gallery', Gallery::class)->name('gallery');
// testimonials
Route::get('/testimonials', Testimonials::class)->name('testimonials');
// news
Route::get('/news', function () {
    return view('news-page');
})->name('news');
// news detail
Route::get('/news/{slug}', function ($slug) {
    return view('news-detail-page', ['slug' => $slug]);
})->name('news.detail');
// news
Route::get('/downloads', function () {
    return view('downloads-page');
})->name('downloads');

// careers
Route::get('/careers', function () {
    return view('careers-page');
})->name('careers');
// career detail
Route::get('/careers/{slug}', function ($slug) {
    return view('career-detail-page', ['slug' => $slug]);
})->name('careers.detail');

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

// facilities
Route::get('/facilities', function () {
    return view('facilities-page');
})->name('facilities');

// Image management routes
Route::delete('/admin/images/{imageId}/remove', [App\Http\Controllers\ImageController::class, 'removeImage'])
    ->name('admin.remove-image')
    ->middleware(['auth', 'web']);

Route::get('/downloads/program/{program:slug}', function (Program $program) {
    return view('downloads-page', ['programId' => $program->id]);
})->name('downloads.by-program');
