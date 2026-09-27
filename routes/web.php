<?php

use App\Livewire\About;
use App\Livewire\ContactUs;
use App\Livewire\Gallery;
use App\Livewire\Home;
use App\Http\Controllers\IndicatorAccessRequestController;
use App\Http\Controllers\IndicatorCheckoutController;
use App\Http\Controllers\StripeWebhookController;
use App\Livewire\IndicatorCatalog;
use App\Livewire\Login;
use App\Livewire\News;
use App\Livewire\Register;
use App\Livewire\Resources;
use App\Livewire\Service;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', Home::class)->name('home');
Route::get('about-us', About::class)->name('about-us');
Route::get('services', Service::class)->name('services');
Route::get('gallery', Gallery::class)->name('gallery');
Route::get('contact-us', ContactUs::class)->name('contact-us');
Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');
Route::get('resources', Resources::class)->name('resources');
Route::get('indicators', IndicatorCatalog::class)->name('indicators.index');
Route::post('indicators/{indicator}/free-request', [IndicatorAccessRequestController::class, 'store'])
	->middleware('throttle:5,1')
	->name('indicators.free-request');
Route::post('indicators/{indicator}/checkout', [IndicatorCheckoutController::class, 'store'])
	->middleware('throttle:5,1')
	->name('indicators.checkout');
Route::get('indicators/purchases/{purchase}/result', [IndicatorCheckoutController::class, 'success'])
	->name('indicators.payment-result');
Route::post('stripe/webhook', StripeWebhookController::class)->name('stripe.webhook');
Route::get('news', News::class)->name('news');
