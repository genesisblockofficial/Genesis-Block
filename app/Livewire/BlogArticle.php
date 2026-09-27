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
        ])->layout('layout.app');
    }
}
