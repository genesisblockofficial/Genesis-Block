<?php

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('blog archive and detail pages show only published articles', function () {
    $published = BlogPost::create([
        'title' => 'Published market guide',
        'slug' => 'published-market-guide',
        'category' => 'Market education',
        'author' => 'Genesis Block',
        'excerpt' => 'A published summary.',
        'content' => "## A useful framework\n\nReview context before acting.",
        'published_at' => now()->subMinute(),
        'is_published' => true,
        'sort_order' => 1,
    ]);

    BlogPost::create([
        'title' => 'Unpublished draft',
        'slug' => 'unpublished-draft',
        'content' => 'This draft must stay private.',
        'published_at' => now()->subMinute(),
        'is_published' => false,
    ]);

    BlogPost::create([
        'title' => 'Future article',
        'slug' => 'future-article',
        'content' => 'This post is scheduled for later.',
        'published_at' => now()->addDay(),
        'is_published' => true,
    ]);

    $this->get(route('blogs.index', [], false))
        ->assertOk()
        ->assertSee($published->title)
        ->assertDontSee('Unpublished draft')
        ->assertDontSee('Future article');

    $this->get(route('blogs.show', $published->slug, false))
        ->assertOk()
        ->assertSee('A useful framework')
        ->assertSee('Review context before acting.');

    $this->get(route('blogs.show', 'unpublished-draft', false))->assertNotFound();
    $this->get(route('blogs.show', 'future-article', false))->assertNotFound();
});
