<main class="account-page">
    <section class="account-hero">
        <div class="container account-hero-inner">
            <div>
                <p class="account-eyebrow">GENESIS BLOCK <span>/</span> MY ACCOUNT</p>
                <h1>Welcome back, {{ $user->first_name ?: $user->name }}.</h1>
                <p>Keep your indicator access, learning plans and account details in one place.</p>
            </div>
            <button class="account-logout" type="button" wire:click="logout">Log out <i class="fas fa-arrow-right-from-bracket" aria-hidden="true"></i></button>
        </div>
    </section>

    <section class="account-content">
        <div class="container">
            <div class="account-profile-strip">
                <div class="account-avatar">{{ $user->initials() }}</div>
                <div>
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="account-profile-meta"><span>Member since</span><strong>{{ $user->created_at->format('M Y') }}</strong></div>
                <a class="account-edit-link" href="{{ route('profile') }}">Edit profile <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            </div>

            <div class="account-section-heading">
                <div><p class="account-eyebrow">YOUR ACCESS</p><h2>My indicators</h2></div>
                <a class="account-browse-link" href="{{ route('indicators.index') }}">Browse indicators <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            </div>

            @if ($indicators->isNotEmpty())
                <div class="account-indicator-grid">
                    @foreach ($indicators as $access)
                        <article class="account-access-card">
                            @if ($access->indicator->cover_image)
                                <img src="{{ asset('storage/' . ltrim($access->indicator->cover_image, '/')) }}" alt="{{ $access->indicator->name }}" loading="lazy">
                            @else
                                <div class="account-access-placeholder"><i class="fas fa-chart-line" aria-hidden="true"></i></div>
                            @endif
                            <div class="account-access-card-body">
                                <span class="account-access-status"><i class="fas fa-circle-check" aria-hidden="true"></i> Access active</span>
                                <h3>{{ $access->indicator->name }}</h3>
                                @if ($access->indicator->summary)<p>{{ $access->indicator->summary }}</p>@endif
                                <a href="{{ route('indicators.index') }}">View indicator <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="account-empty-state"><i class="fas fa-chart-line" aria-hidden="true"></i><div><h3>No indicator access yet</h3><p>When an access request is approved or a purchase is completed, the indicator will appear here.</p></div><a class="account-browse-link" href="{{ route('indicators.index') }}">Explore indicators <i class="fas fa-arrow-right" aria-hidden="true"></i></a></div>
            @endif

            <div class="account-section-heading account-courses-heading">
                <div><p class="account-eyebrow">LEARNING PATH</p><h2>My courses</h2></div>
            </div>
            <div class="account-empty-state account-course-state"><i class="fas fa-graduation-cap" aria-hidden="true"></i><div><span class="account-coming-soon">Coming soon</span><h3>Courses are on the way</h3><p>Your enrolled courses, progress and saved lessons will appear here when the course library launches.</p></div><a class="account-browse-link" href="{{ route('courses.index') }}">View courses <i class="fas fa-arrow-right" aria-hidden="true"></i></a></div>
        </div>
    </section>
</main>
