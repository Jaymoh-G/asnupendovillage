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
