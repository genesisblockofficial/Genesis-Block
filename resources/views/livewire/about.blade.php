<!-- About Section -->
<section class="about-section" id="about">
    <div class="container">
        <!-- Hero Section -->
        <div class="about-hero">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="about-title">{{ $aboutUs->main_heading ?? 'Redefining Trading Excellence' }}</h1>
                    <p class="about-subtitle">
                        {{ $aboutUs->sub_heading ??
                            'Genesis Block is a global leader in multi-asset trading, combining cutting-edge technology with deep market expertise to empower traders worldwide. Founded in 2015, weve grown to serve over 2 million traders across 150+ countries' }}
                    </p>
                    @if (!empty($aboutUs->_is_start_trading) || !empty($aboutUs->_is_view_our_mission))
                        <div class="about-cta-buttons">
                            @if ($aboutUs->_is_start_trading)
                                <button class="btn btn-primary">Start Trading</button>
                            @endif
                            @if ($aboutUs->_is_view_our_mission)
                                <button class="btn btn-secondary">Our Mission</button>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="about-hero-image">
                        <div class="trading-stats-card">
                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-number" data-count="8">{{ $aboutUs->experience_year ?? '0' }}</div>
                                    <div class="stat-label">Years Experience</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number" data-count="2">{{ $aboutUs->traders_count ?? '0' }}</div>
                                    <div class="stat-label">Million+ Traders</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number" data-count="4.2">{{ $aboutUs->traders_volumn ?? '0' }}
                                    </div>
                                    <div class="stat-label">Trillion+ Volume</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number" data-count="150">{{ $aboutUs->countries_count ?? '0' }}
                                    </div>
                                    <div class="stat-label">Countries</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="about-mission-section">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="mission-card">
                        <div class="mission-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>Our Mission</h3>
                        @if (!empty($aboutUs->mission))
                            <p>{!! $aboutUs->mission !!}</p>
                        @else
                            <p>To empower traders of all levels with institutional-grade tools, real-time market
                                insights,
                                and a secure trading environment that fosters growth and success in global financial
                                markets.</p>
                            <ul class="mission-list">
                                <li><i class="fas fa-check-circle"></i> Provide transparent, competitive pricing</li>
                                <li><i class="fas fa-check-circle"></i> Deliver cutting-edge trading technology</li>
                                <li><i class="fas fa-check-circle"></i> Ensure bank-level security for all clients</li>
                                <li><i class="fas fa-check-circle"></i> Foster financial literacy through education</li>
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-card">
                        <div class="mission-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3>Our Vision</h3>
                        @if (!empty($aboutUs->vission))
                            <p>{!! $aboutUs->vission !!}</p>
                        @else
                            <p>To become the world's most trusted and innovative trading platform, bridging the gap
                                between
                                retail and institutional trading while setting new standards for transparency and client
                                success.</p>
                            <ul class="mission-list">
                                <li><i class="fas fa-check-circle"></i> Expand to 5 million traders by 2025</li>
                                <li><i class="fas fa-check-circle"></i> Launch AI-powered trading assistants</li>
                                <li><i class="fas fa-check-circle"></i> Introduce blockchain settlement systems</li>
                                <li><i class="fas fa-check-circle"></i> Pioneer sustainable trading initiatives</li>
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="about-timeline-section">
            <h2 class="section-title">Our Journey</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2015</div>
                    <div class="timeline-content">
                        <h4>Foundation</h4>
                        <p>Genesis Block was founded by a team of former Wall Street traders and fintech experts.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2017</div>
                    <div class="timeline-content">
                        <h4>Platform Launch</h4>
                        <p>Launched our proprietary trading platform with advanced charting tools.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2019</div>
                    <div class="timeline-content">
                        <h4>Global Expansion</h4>
                        <p>Expanded operations to Europe and Asia, securing regulatory licenses.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2021</div>
                    <div class="timeline-content">
                        <h4>Mobile Revolution</h4>
                        <p>Launched award-winning mobile apps reaching 1 million active users.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h4>AI Integration</h4>
                        <p>Integrated AI-powered trading signals and risk management tools.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Values -->
        <div class="about-values-section">
            <h2 class="section-title">Our Core Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h4>{{ $aboutUs->core_value_title_1 ?? 'Security First' }}</h4>
                    <p>{{ $aboutUs->core_value_description_1 ?? 'Client funds and data security are our top priority with military-grade encryption.' }}
                    </p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h4>{{ $aboutUs->core_value_title_2 ?? 'Transparency' }}</h4>
                    <p>{{ $aboutUs->core_value_description_2 ?? 'No hidden fees, no surprises. Complete transparency in pricing and execution.' }}
                    </p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4>{{ $aboutUs->core_value_title_3 ?? 'Innovation' }}</h4>
                    <p>{{ $aboutUs->core_value_description_3 ?? 'Constantly pushing boundaries with new technologies to enhance trading experience.' }}
                    </p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>{{ $aboutUs->core_value_title_4 ?? 'Education' }}</h4>
                    <p>{{ $aboutUs->core_value_description_4 ?? 'Empowering traders with knowledge through comprehensive educational resources.' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Leadership Team -->
        <div class="about-team-section">
            <h2 class="section-title">Leadership Team</h2>
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="team-info">
                        <h4>Michael Chen</h4>
                        <p class="team-role">CEO & Founder</p>
                        <p class="team-bio">Former Goldman Sachs trader with 15+ years of experience in global markets.
                        </p>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="team-info">
                        <h4>Sarah Johnson</h4>
                        <p class="team-role">Chief Technology Officer</p>
                        <p class="team-bio">Fintech expert specializing in high-frequency trading systems and
                            blockchain.</p>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="team-info">
                        <h4>David Rodriguez</h4>
                        <p class="team-role">Chief Security Officer</p>
                        <p class="team-bio">Cybersecurity specialist with background in banking and financial services.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
    <script>
        // About Section JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Animate counting stats
            function animateCounter(element, target, duration = 2000) {
                let start = 0;
                const increment = target / (duration / 16);
                const timer = setInterval(() => {
                    start += increment;
                    if (start >= target) {
                        element.textContent = target + (target >= 1 ? '+' : '');
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(start);
                    }
                }, 16);
            }

            // Initialize counters when section is in view
            const observerOptions = {
                threshold: 0.3,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Animate stats counters
                        const statNumbers = document.querySelectorAll('.stat-number');
                        statNumbers.forEach(stat => {
                            const target = parseFloat(stat.getAttribute('data-count'));
                            animateCounter(stat, target);
                        });

                        // Add animation classes to timeline items
                        const timelineItems = document.querySelectorAll('.timeline-item');
                        timelineItems.forEach((item, index) => {
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'translateY(0)';
                            }, index * 300);
                        });

                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe the about section
            const aboutSection = document.querySelector('.about-section');
            if (aboutSection) {
                observer.observe(aboutSection);
            }

            // Initialize timeline items with hidden state
            const timelineItems = document.querySelectorAll('.timeline-item');
            timelineItems.forEach(item => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });

            // Mission card hover effects
            const missionCards = document.querySelectorAll('.mission-card');
            missionCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(-5px)';
                });
            });

            // Team card hover effects
            const teamCards = document.querySelectorAll('.team-card');
            teamCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(-10px) scale(1)';
                });
            });

            // Value cards hover effects
            const valueCards = document.querySelectorAll('.value-card');
            valueCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('.value-icon');
                    if (icon) {
                        icon.style.transform = 'scale(1.1) rotate(5deg)';
                        icon.style.transition = 'transform 0.3s ease';
                    }
                });

                card.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('.value-icon');
                    if (icon) {
                        icon.style.transform = 'scale(1) rotate(0)';
                    }
                });
            });

            // Add click event to mission/vision buttons
            const missionButtons = document.querySelectorAll('.mission-card, .value-card');
            missionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'translateY(-5px) scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'translateY(-5px) scale(1)';
                    }, 150);
                });
            });

            // Smooth scroll to section
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#about') {
                        document.querySelector(targetId).scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endpush
