<?php

namespace App\Livewire;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Livewire\Component;

class BlogArticle extends Component
{
    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public string $slug;

    public function render()
    {
        $post = BlogPost::query()
            ->published()
            ->where('slug', $this->slug)
            ->firstOrFail();

        $relatedPosts = BlogPost::query()
            ->published()
            ->whereKeyNot($post->id)
            ->when($post->category, fn ($query) => $query->where('category', $post->category))
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('livewire.blog-article', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'renderedContent' => Str::markdown($post->content, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]),
        ])->layout('layout.app', [
            'seoTitle' => $post->title.' | Genesis Block',
            'seoDescription' => Str::limit(strip_tags($post->excerpt ?: $post->content), 160),
            'seoCanonical' => route('blogs.show', ['slug' => $post->slug]),
            'seoImage' => $post->cover_image ? asset('storage/'.ltrim($post->cover_image, '/')) : null,
            'seoType' => 'article',
            'seoNoIndex' => false,
            'seoStructuredData' => [[
                '@type' => 'Article',
                'headline' => $post->title,
                'description' => Str::limit(strip_tags($post->excerpt ?: $post->content), 300),
                'datePublished' => $post->published_at->toIso8601String(),
                'dateModified' => $post->updated_at->toIso8601String(),
                'author' => [
                    '@type' => 'Organization',
                    'name' => $post->author ?: config('app.name', 'Genesis Block'),
                ],
                'publisher' => ['@id' => route('home').'#organization'],
                'mainEntityOfPage' => route('blogs.show', ['slug' => $post->slug]),
                ...($post->cover_image ? ['image' => asset('storage/'.ltrim($post->cover_image, '/'))] : []),
            ]],
        ]);
    }
}
