<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = collect(['home', 'about-us', 'contact-us', 'blogs.index'])
            ->map(fn (string $name): array => [
                'loc' => route($name),
                'lastmod' => null,
            ]);

        $articles = BlogPost::query()
            ->published()
            ->get(['slug', 'updated_at'])
            ->map(fn (BlogPost $post): array => [
                'loc' => route('blogs.show', ['slug' => $post->slug]),
                'lastmod' => $post->updated_at?->toAtomString(),
            ]);

        return response()
            ->view('sitemap', ['urls' => $urls->concat($articles)])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
