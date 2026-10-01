<?php

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('public pages render canonical social metadata and protected pages are noindex', function () {
    $this->get(route('blogs.index', [], false))
        ->assertOk()
        ->assertSee('<meta name="description"', false)
        ->assertSee('<link rel="canonical"', false)
        ->assertSee('application/ld+json', false);

    $this->get(route('login', [], false))
        ->assertOk()
        ->assertSee('noindex, nofollow');
});

test('sitemap includes public routes and published articles only', function () {
    BlogPost::create([
        'title' => 'Published Market Article',
        'slug' => 'published-market-article',
        'content' => 'Published content',
        'published_at' => now(),
        'is_published' => true,
    ]);
    BlogPost::create([
        'title' => 'Draft Market Article',
        'slug' => 'draft-market-article',
        'content' => 'Draft content',
        'published_at' => now()->addDay(),
        'is_published' => false,
    ]);

    $this->get(route('blogs.show', ['slug' => 'published-market-article'], false))
        ->assertOk()
        ->assertSee('<title>Published Market Article | Genesis Block</title>', false)
        ->assertSee('property="og:type" content="article"', false)
        ->assertSee('"@type":"Article"', false);

    $this->get(route('sitemap', [], false))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertSee(route('home'))
        ->assertSee(route('blogs.show', ['slug' => 'published-market-article']))
        ->assertDontSee('draft-market-article')
        ->assertDontSee('/account');
});

test('robots file advertises the sitemap and blocks admin paths', function () {
    $this->get(route('robots', [], false))
        ->assertOk()
        ->assertSee('Disallow: /admin')
        ->assertSee('Sitemap: '.route('sitemap'));
});
