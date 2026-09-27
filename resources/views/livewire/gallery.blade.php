<main class="gallery-page">
    <section class="gallery-hero">
        <div class="container gallery-hero-layout">
            <div>
                <p class="gallery-eyebrow">GENESIS BLOCK <span>/</span> THE GALLERY</p>
                <h1>Glimpses from<br><span>our community.</span></h1>
                <p>A collection of moments and images shared by the Genesis Block team.</p>
            </div>
            <div class="gallery-count-block">
                <strong>{{ $galleryItems->count() }}</strong>
                <span>{{ \Illuminate\Support\Str::plural('image', $galleryItems->count()) }} shared</span>
            </div>
        </div>
    </section>

    <section class="gallery-library">
        <div class="container">
            @if ($galleryItems->isNotEmpty())
                <div class="gallery-toolbar">
                    <p>Browse the collection</p>
                    <div class="gallery-filters" role="group" aria-label="Filter gallery by collection">
                        <button class="gallery-filter is-active" type="button" data-gallery-filter="all" aria-pressed="true">All images</button>
                        @foreach ($categories as $category)
                            <button class="gallery-filter" type="button"
                                data-gallery-filter="{{ \Illuminate\Support\Str::slug($category) }}" aria-pressed="false">{{ $category }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="gallery-grid">
                    @foreach ($galleryItems as $index => $item)
                        <article class="gallery-card" data-category="{{ \Illuminate\Support\Str::slug($item['category']) }}">
                            <button class="gallery-image-trigger" type="button" data-gallery-trigger
                                data-image="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset('storage/' . ltrim($item['image'], '/')) }}"
                                data-title="{{ $item['title'] }}"
                                data-description="{{ $item['description'] ?: $item['category'] }}"
                                aria-label="Open image: {{ $item['title'] }}">
                                <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset('storage/' . ltrim($item['image'], '/')) }}"
                                    alt="{{ $item['title'] }}" loading="{{ $index < 3 ? 'eager' : 'lazy' }}">
                                <span class="gallery-image-overlay">
                                    <span class="gallery-image-caption">
                                        <small>{{ $item['category'] }}</small>
                                        <strong>{{ $item['title'] }}</strong>
                                    </span>
                                    <span class="gallery-expand-icon" aria-hidden="true"><i class="fas fa-expand"></i></span>
                                </span>
                            </button>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="gallery-empty-state">
                    <span class="gallery-empty-mark" aria-hidden="true"><i class="far fa-images"></i></span>
                    <h2>Our gallery is taking shape.</h2>
                    <p>New photos shared by the Genesis Block team will appear here.</p>
                </div>
            @endif
        </div>
    </section>

    <div class="gallery-lightbox" data-gallery-lightbox hidden role="dialog" aria-modal="true" aria-label="Gallery image viewer">
        <button class="gallery-lightbox-close" type="button" data-lightbox-close aria-label="Close image viewer">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
        <button class="gallery-lightbox-nav gallery-lightbox-prev" type="button" data-lightbox-prev aria-label="Previous image">
            <i class="fas fa-chevron-left" aria-hidden="true"></i>
        </button>
        <figure class="gallery-lightbox-figure">
            <img data-lightbox-image src="" alt="">
            <figcaption>
                <div><small data-lightbox-category></small><h2 data-lightbox-title></h2><p data-lightbox-description></p></div>
                <span data-lightbox-counter></span>
            </figcaption>
        </figure>
        <button class="gallery-lightbox-nav gallery-lightbox-next" type="button" data-lightbox-next aria-label="Next image">
            <i class="fas fa-chevron-right" aria-hidden="true"></i>
        </button>
    </div>
</main>

@script
    <script>
        const galleryRoot = $wire.el;
        const lightbox = galleryRoot.querySelector('[data-gallery-lightbox]');
        const lightboxImage = lightbox.querySelector('[data-lightbox-image]');
        const lightboxTitle = lightbox.querySelector('[data-lightbox-title]');
        const lightboxCategory = lightbox.querySelector('[data-lightbox-category]');
        const lightboxDescription = lightbox.querySelector('[data-lightbox-description]');
        const lightboxCounter = lightbox.querySelector('[data-lightbox-counter]');
        let visibleCards = [];
        let currentIndex = 0;
        let returnFocusTo = null;

        const updateLightbox = () => {
            const trigger = visibleCards[currentIndex]?.querySelector('[data-gallery-trigger]');
            if (!trigger) return;

            lightboxImage.src = trigger.dataset.image;
            lightboxImage.alt = trigger.getAttribute('aria-label').replace('Open image: ', '');
            lightboxTitle.textContent = trigger.dataset.title;
            lightboxCategory.textContent = trigger.closest('.gallery-card').dataset.category.replaceAll('-', ' ');
            lightboxDescription.textContent = trigger.dataset.description;
            lightboxCounter.textContent = `${currentIndex + 1} / ${visibleCards.length}`;
        };

        const closeLightbox = () => {
            lightbox.hidden = true;
            lightboxImage.src = '';
            document.body.style.overflow = '';
            returnFocusTo?.focus();
        };

        galleryRoot.addEventListener('click', (event) => {
            const filterButton = event.target.closest('[data-gallery-filter]');
            if (filterButton) {
                const selectedCategory = filterButton.dataset.galleryFilter;
                galleryRoot.querySelectorAll('.gallery-filter').forEach((button) => {
                    const isActive = button === filterButton;
                    button.classList.toggle('is-active', isActive);
                    button.setAttribute('aria-pressed', String(isActive));
                });
                galleryRoot.querySelectorAll('.gallery-card').forEach((card) => {
                    card.hidden = selectedCategory !== 'all' && card.dataset.category !== selectedCategory;
                });
                return;
            }

            const trigger = event.target.closest('[data-gallery-trigger]');
            if (trigger) {
                visibleCards = [...galleryRoot.querySelectorAll('.gallery-card:not([hidden])')];
                currentIndex = visibleCards.indexOf(trigger.closest('.gallery-card'));
                returnFocusTo = trigger;
                updateLightbox();
                lightbox.hidden = false;
                document.body.style.overflow = 'hidden';
                lightbox.querySelector('[data-lightbox-close]').focus();
                return;
            }

            if (event.target === lightbox || event.target.closest('[data-lightbox-close]')) {
                closeLightbox();
            }
        });

        lightbox.querySelector('[data-lightbox-prev]').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + visibleCards.length) % visibleCards.length;
            updateLightbox();
        });
        lightbox.querySelector('[data-lightbox-next]').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % visibleCards.length;
            updateLightbox();
        });
        document.addEventListener('keydown', (event) => {
            if (lightbox.hidden) return;
            if (event.key === 'Escape') closeLightbox();
            if (event.key === 'ArrowLeft') lightbox.querySelector('[data-lightbox-prev]').click();
            if (event.key === 'ArrowRight') lightbox.querySelector('[data-lightbox-next]').click();
        });
    </script>
@endscript
