<?php

use App\Http\Controllers\EconomicCalendarController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\IndicatorAccessRequestController;
use App\Http\Controllers\IndicatorCheckoutController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\StripeWebhookController;
use App\Livewire\About;
use App\Livewire\BlogArticle;
use App\Livewire\BlogIndex;
use App\Livewire\ContactUs;
use App\Livewire\Courses;
use App\Livewire\Faqs;
use App\Livewire\Gallery;
use App\Livewire\Home;
use App\Livewire\IndicatorCatalog;
use App\Livewire\Journal;
use App\Livewire\Journey;
use App\Livewire\Login;
use App\Livewire\News;
use App\Livewire\Register;
use App\Livewire\Resources;
use App\Livewire\Settings\Profile;
use App\Livewire\TeamMembers;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/robots.txt', function () {
    return response(implode("\n", [
        'User-agent: *',
        'Allow: /',
        'Disallow: /admin',
        'Disallow: /account',
        'Disallow: /profile',
        'Disallow: /journal',
        'Disallow: /auth/google',
        'Sitemap: '.route('sitemap'),
        '',
    ]), 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
})->name('robots');
Route::get('about-us', About::class)->name('about-us');
Route::get('courses', Courses::class)->middleware('auth')->name('courses.index');
Route::get('journal', Journal::class)->middleware('auth')->name('journal');
Route::redirect('services', '/courses', 301)->name('services');
Route::get('gallery', Gallery::class)->middleware('auth')->name('gallery');
Route::get('team-members', TeamMembers::class)->middleware('auth')->name('team-members');
Route::get('contact-us', ContactUs::class)->name('contact-us');
Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');
Route::get('auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');
Route::get('resources', Resources::class)->middleware('auth')->name('resources');
Route::get('indicators', IndicatorCatalog::class)->middleware('auth')->name('indicators.index');
Route::get('faqs', Faqs::class)->middleware('auth')->name('faqs');
Route::get('blogs', BlogIndex::class)->name('blogs.index');
Route::get('journey', Journey::class)->middleware('auth')->name('journey');
Route::get('blogs/{slug}', BlogArticle::class)->name('blogs.show');
Route::post('indicators/{indicator}/free-request', [IndicatorAccessRequestController::class, 'store'])
    ->middleware(['auth', 'throttle:5,1'])
    ->name('indicators.free-request');
Route::post('indicators/{indicator}/checkout', [IndicatorCheckoutController::class, 'store'])
    ->middleware(['auth', 'throttle:5,1'])
    ->name('indicators.checkout');
Route::get('indicators/purchases/{purchase}/result', [IndicatorCheckoutController::class, 'success'])
    ->name('indicators.payment-result');
Route::post('stripe/webhook', StripeWebhookController::class)->name('stripe.webhook');
Route::get('news', News::class)->middleware('auth')->name('news');
Route::get('account', \App\Livewire\AccountDashboard::class)
    ->middleware('auth')
    ->name('account');
Route::get('profile', Profile::class)->middleware('auth')->name('profile');
Route::get('api/news/economic-calendar', EconomicCalendarController::class)
    ->middleware('throttle:30,1')
    ->name('api.news.economic-calendar');
