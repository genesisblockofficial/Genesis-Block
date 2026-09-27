<?php

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('courses page shows active courses and keeps inactive courses hidden', function () {
    $publishedCourse = Service::create([
        'title' => 'Market foundations',
        'description' => '<p>Start with core market concepts.</p>',
        'is_active' => true,
    ]);

    $publishedCourse->serviceDetails()->create([
        'title' => 'What you will learn',
        'description' => '<p>Build a structured understanding.</p>',
    ]);

    Service::create([
        'title' => 'Unpublished course',
        'description' => 'This course is not ready.',
        'is_active' => false,
    ]);

    $this->get(route('courses.index', [], false))
        ->assertOk()
        ->assertSee('Market foundations')
        ->assertSee('What you will learn')
        ->assertDontSee('Unpublished course')
        ->assertDontSee('Courses are coming soon.');
});
