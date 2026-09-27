<main class="blog-article-page">
    <section class="blog-article-hero">
        <div class="container blog-article-hero-inner">
            <a class="blog-back-link" href="{{ route('blogs.index') }}"><i class="fas fa-arrow-left" aria-hidden="true"></i> All articles</a>
            <div class="blog-article-meta">
                @if ($post->category)<span>{{ $post->category }}</span>@endif
                <time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at->format('F j, Y') }}</time>
                @if ($post->author)<span>By {{ $post->author }}</span>@endif
            </div>
            <h1>{{ $post->title }}</h1>
            @if ($post->excerpt)
                <p class="blog-article-excerpt">{{ $post->excerpt }}</p>
            @endif
        </div>
    </section>

    @if ($post->cover_image)
        <figure class="container blog-article-cover">
            <img src="{{ asset('storage/' . ltrim($post->cover_image, '/')) }}" alt="{{ $post->title }}" fetchpriority="high">
        </figure>
    @endif

    <article class="container blog-article-content">
        <div class="blog-markdown">{!! $renderedContent !!}</div>
    </article>

    @if ($relatedPosts->isNotEmpty())
        <section class="blog-related">
            <div class="container">
                <p class="blogs-eyebrow">KEEP READING</p>
                <h2>Related articles</h2>
                <div class="blog-related-links">
                    @foreach ($relatedPosts as $relatedPost)
                        <a href="{{ route('blogs.show', $relatedPost->slug) }}">
                            <span>{{ $relatedPost->category ?: 'Article' }}</span>
                            <strong>{{ $relatedPost->title }}</strong>
                            <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</main>
