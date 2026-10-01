<?php

namespace App\Livewire;

use App\Models\BlogPost;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BlogIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public string $search = '';

    #[Url(except: '')]
    public string $category = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = BlogPost::query()
            ->published()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $posts = BlogPost::query()
            ->published()
            ->when($this->category !== '', fn ($query) => $query->where('category', $this->category))
            ->when($this->search !== '', function ($query): void {
                $search = '%'.addcslashes($this->search, '%_\\').'%';

                $query->where(function ($query) use ($search): void {
                    $query->where('title', 'like', $search)
                        ->orWhere('excerpt', 'like', $search)
                        ->orWhere('content', 'like', $search);
                });
            })
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('livewire.blog-index', [
            'posts' => $posts,
            'categories' => $categories,
        ])->layout('layout.app', [
            'seoTitle' => 'Market Education Articles & Trading Insights | Genesis Block',
            'seoDescription' => 'Read Genesis Block articles on market education, trading tools, indicators and research.',
            'seoCanonical' => route('blogs.index'),
        ]);
    }
}
