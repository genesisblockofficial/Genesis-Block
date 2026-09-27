<main class="about-page">
    <section class="about-hero">
        <div class="container about-hero-layout">
            <div class="about-hero-copy">
                <p class="about-eyebrow">GENESIS BLOCK <span>/</span> ABOUT US</p>
                <h1>{{ filled($aboutUs?->main_heading) ? $aboutUs->main_heading : 'Education for a clearer view of markets.' }}</h1>
                <p class="about-hero-description">
                    {{ filled($aboutUs?->sub_heading) ? $aboutUs->sub_heading : 'We make market concepts easier to explore through clear learning resources, thoughtful context and practical education.' }}
                </p>
                <div class="about-hero-actions">
                    <a class="about-button about-button-primary" href="#our-approach">Our approach <i class="fas fa-arrow-down" aria-hidden="true"></i></a>
                    <a class="about-text-link" href="{{ route('courses.index') }}">Explore courses</a>
                </div>
            </div>
            <figure class="about-hero-figure">
                <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1400&q=85"
                    alt="Colleagues sharing ideas around a table">
                <figcaption><span>Learn together. Think independently.</span><span>GENESIS BLOCK</span></figcaption>
            </figure>
        </div>
    </section>

    <section class="about-approach" id="our-approach">
        <div class="container">
            <div class="about-section-intro">
                <p class="about-eyebrow">WHAT GUIDES US</p>
                <h2>We believe understanding<br><span>comes before action.</span></h2>
            </div>
            <div class="about-purpose-grid">
                <article>
                    <span class="about-index">01 / OUR MISSION</span>
                    <h3>Make learning useful.</h3>
                    <p>{{ filled($aboutUs?->mission) ? strip_tags($aboutUs->mission) : 'Our mission is to make financial-market concepts more approachable with clear explanations, practical learning and thoughtful context.' }}</p>
                </article>
                <article>
                    <span class="about-index">02 / OUR VISION</span>
                    <h3>Support independent thinking.</h3>
                    <p>{{ filled($aboutUs?->vission) ? strip_tags($aboutUs->vission) : 'Our vision is a more informed learning community where people can ask better questions and form their own understanding of markets.' }}</p>
                </article>
            </div>
        </div>
    </section>

    <section class="about-values">
        <div class="container">
            <div class="about-section-intro about-values-intro">
                <p class="about-eyebrow">OUR PRINCIPLES</p>
                <h2>Good learning starts<br><span>with good principles.</span></h2>
            </div>
            <div class="about-values-grid">
                @foreach ([
                    ['title' => $aboutUs?->core_value_title_1 ?: 'Clarity', 'description' => $aboutUs?->core_value_description_1 ?: 'Explain ideas in plain language and make room for thoughtful questions.'],
                    ['title' => $aboutUs?->core_value_title_2 ?: 'Context', 'description' => $aboutUs?->core_value_description_2 ?: 'Connect concepts to the wider picture instead of relying on isolated signals.'],
                    ['title' => $aboutUs?->core_value_title_3 ?: 'Curiosity', 'description' => $aboutUs?->core_value_description_3 ?: 'Keep exploring, stay open to evidence and learn from different perspectives.'],
                    ['title' => $aboutUs?->core_value_title_4 ?: 'Responsibility', 'description' => $aboutUs?->core_value_description_4 ?: 'Treat education as a starting point for informed, independent decisions.'],
                ] as $index => $value)
                    <article class="about-value-item">
                        <span class="about-index">0{{ $index + 1 }}</span>
                        <h3>{{ $value['title'] }}</h3>
                        <p>{{ $value['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @if ($journeys->isNotEmpty())
        <section class="about-journey">
            <div class="container">
                <div class="about-section-intro">
                    <p class="about-eyebrow">OUR JOURNEY</p>
                    <h2>Built step by step.</h2>
                </div>
                <div class="about-journey-list">
                    @foreach ($journeys as $journey)
                        <article>
                            <span class="about-journey-year">{{ $journey->years }}</span>
                            <div>
                                <h3>{{ $journey->title }}</h3>
                                @if (filled($journey->description))
                                    <p>{{ $journey->description }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($teamMembers->isNotEmpty())
        <section class="about-team">
            <div class="container">
                <div class="about-section-intro">
                    <p class="about-eyebrow">THE PEOPLE BEHIND THE WORK</p>
                    <h2>A team that values<br><span>learning and perspective.</span></h2>
                </div>
                <div class="about-team-grid">
                    @foreach ($teamMembers as $member)
                        <article class="about-team-member">
                            @if ($member->photo)
                                <img src="{{ asset('storage/' . ltrim($member->photo, '/')) }}" alt="{{ $member->name }}" loading="lazy">
                            @else
                                <div class="about-team-placeholder" aria-hidden="true"><i class="fas fa-user" aria-hidden="true"></i></div>
                            @endif
                            <div class="about-team-member-copy">
                                <h3>{{ $member->name }}</h3>
                                @if (filled($member->position))
                                    <p class="about-team-role">{{ $member->position }}</p>
                                @endif
                                @if (filled($member->description))
                                    <p>{{ $member->description }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="about-contact">
        <div class="container about-contact-layout">
            <div>
                <p class="about-eyebrow">KEEP THE CONVERSATION GOING</p>
                <h2>Curious about<br><span>what we do?</span></h2>
            </div>
            <div>
                <p>Reach out with questions about Genesis Block, our approach or the learning resources on this site.</p>
                <a class="about-button about-button-light" href="{{ route('contact-us') }}">Contact us <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </section>
</main>
