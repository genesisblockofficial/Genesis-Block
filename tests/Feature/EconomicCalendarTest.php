<?php

use App\Models\EconomicCalendarSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

test('disabled calendar settings explain that the admin must enable saved credentials', function () {
    EconomicCalendarSettings::create([
        'enabled' => false,
        'api_key' => 'test-finnhub-key',
    ]);

    $this->get(route('api.news.economic-calendar', ['from' => now()->toDateString(), 'to' => now()->toDateString()]))
        ->assertStatus(503)
        ->assertJsonPath('configured', false)
        ->assertJsonPath('message', 'Live economic events are disabled or the Finnhub API key is missing. Enable live events and save the key in Admin → Website CRM → Economic Calendar.');
});

test('finnhub permission errors are reported as account access problems', function () {
    EconomicCalendarSettings::create([
        'enabled' => true,
        'api_key' => 'test-finnhub-key',
    ]);
    Http::fake([
        'finnhub.io/*' => Http::response(['error' => "You don't have access to this resource."], 403),
    ]);

    $this->get(route('api.news.economic-calendar', ['from' => now()->toDateString(), 'to' => now()->toDateString()]))
        ->assertStatus(502)
        ->assertJsonPath('configured', true)
        ->assertJsonPath('message', 'Finnhub denied access to the economic calendar for this key/account. Check that your Finnhub account has access to this API resource.');
});
