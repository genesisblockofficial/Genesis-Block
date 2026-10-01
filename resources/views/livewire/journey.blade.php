<main class="journey-page">
    <section class="journey-hero">
        <div class="container journey-hero-inner">
            <p class="account-eyebrow">GENESIS BLOCK <span>/</span> OUR JOURNEY</p>
            <h1>A story built<br><span>one step at a time.</span></h1>
            <p>Explore the milestones, ideas and people that have shaped Genesis Block.</p>
        </div>
    </section>

    <section class="journey-content">
        <div class="container">
            @if ($milestones->isNotEmpty())
                <div class="journey-timeline">
                    @foreach ($milestones as $milestone)
                        <article class="journey-milestone"><div class="journey-year">{{ $milestone->years }}</div><div class="journey-marker"></div><div class="journey-milestone-copy"><h2>{{ $milestone->title }}</h2><p>{{ $milestone->description }}</p></div></article>
                    @endforeach
                </div>
            @else
                <div class="journey-empty"><i class="fas fa-route" aria-hidden="true"></i><h2>Our journey is being written</h2><p>Journey milestones will appear here when they are published by the admin team.</p></div>
            @endif
        </div>
    </section>
</main>
