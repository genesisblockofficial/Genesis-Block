<main class="team-page">
    <section class="team-hero">
        <div class="container team-hero-inner">
            <p class="account-eyebrow">GENESIS BLOCK <span>/</span> OUR PEOPLE</p>
            <h1>Meet the people<br><span>behind the work.</span></h1>
            <p>Get to know the team building clear, practical market education for independent learners.</p>
        </div>
    </section>

    <section class="team-content">
        <div class="container">
            @if ($members->isNotEmpty())
                <div class="team-grid">
                    @foreach ($members as $member)
                        <article class="team-card">
                            @if ($member->photo)
                                <img src="{{ asset('storage/' . ltrim($member->photo, '/')) }}" alt="{{ $member->name }}" loading="lazy">
                            @else
                                <div class="team-photo-placeholder">{{ collect(explode(' ', $member->name))->map(fn ($part) => substr($part, 0, 1))->take(2)->join('') }}</div>
                            @endif
                            <div class="team-card-body">
                                <p class="team-position">{{ $member->position }}</p>
                                <h2>{{ $member->name }}</h2>
                                @if ($member->description)<p>{{ $member->description }}</p>@endif
                                <div class="team-socials">
                                    @foreach (['linkedin' => 'linkedin-in', 'twitter' => 'x-twitter', 'facebook' => 'facebook-f', 'instagram' => 'instagram', 'youtube' => 'youtube'] as $field => $icon)
                                        @if ($member->{$field})<a href="{{ $member->{$field} }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($field) }} profile"><i class="fab fa-{{ $icon }}" aria-hidden="true"></i></a>@endif
                                    @endforeach
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="team-empty"><i class="fas fa-users" aria-hidden="true"></i><h2>Our team is taking shape</h2><p>Team member profiles will appear here when they are published by the admin team.</p></div>
            @endif
        </div>
    </section>
</main>
