<main class="blogs-page">
    <section class="blogs-hero">
        <div class="container blogs-hero-layout">
            <div>
                <p class="blogs-eyebrow">GENESIS BLOCK <span>/</span> BLOG</p>
                <h1>Ideas worth<br><span>thinking through.</span></h1>
                <p>Explore market explainers, trading perspectives and ideas for deliberate, continuous learning.</p>
            </div>
            <form class="blogs-search" role="search" wire:submit.prevent>
                <label for="blog-search">Search articles</label>
                <div>
                    <input id="blog-search" type="search" wire:model.live.debounce.300ms="search" placeholder="Search by topic or title">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </div>
            </form>
        </div>
    </section>

    <section class="blogs-archive">
        <div class="container">
            <div class="blogs-archive-heading">
                <div><p class="blogs-eyebrow">LATEST ARTICLES</p><h2>Read, reflect, revisit.</h2></div>
                <label class="blogs-category-filter" for="blog-category">
                    <span>Category</span>
                    <select id="blog-category" wire:model.live="category">
                        <option value="">All topics</option>
                        @foreach ($categories as $categoryOption)
                            <option value="{{ $categoryOption }}">{{ $categoryOption }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            @if ($posts->isNotEmpty())
                <div class="blogs-grid">
                    @foreach ($posts as $post)
                        <article class="blog-card">
                            <a class="blog-card-image" href="{{ route('blogs.show', $post->slug) }}" tabindex="-1" aria-hidden="true">
                                @if ($post->cover_image)
                                    <img src="{{ asset('storage/' . ltrim($post->cover_image, '/')) }}" alt="" loading="lazy">
                                @else
                                    <span class="blog-cover-placeholder" aria-hidden="true">{{ strtoupper(substr($post->title, 0, 1)) }}</span>
                                @endif
                            </a>
                            <div class="blog-card-content">
                                <div class="blog-card-meta">
                                    @if ($post->category)<span>{{ $post->category }}</span>@endif
                                    <time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at->format('M j, Y') }}</time>
                                </div>
                                <h3><a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a></h3>
                                @if ($post->excerpt)
                                    <p>{{ $post->excerpt }}</p>
                                @endif
                                <a class="blog-read-link" href="{{ route('blogs.show', $post->slug) }}">Read article <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="blogs-pagination">{{ $posts->links() }}</div>
            @else
                <div class="blogs-empty-state">
                    <h3>No articles found.</h3>
                    <p>Try another search or category, or check back when new articles are published.</p>
                </div>
            @endif
        </div>
    </section>
</main>
