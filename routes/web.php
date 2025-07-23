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
Route::get('/downloads', function () {
    return view('downloads-page');
})->name('downloads');

// Image management routes
Route::delete('/admin/images/{imageId}/remove', [App\Http\Controllers\ImageController::class, 'removeImage'])
    ->name('admin.remove-image')
    ->middleware(['auth', 'web']);

Route::get('/downloads/program/{program:slug}', function (Program $program) {
    return view('downloads-page', ['programId' => $program->id]);
})->name('downloads.by-program');
