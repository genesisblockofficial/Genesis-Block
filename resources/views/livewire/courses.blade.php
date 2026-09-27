<main class="courses-page">
    @if ($courses->isEmpty())
    <section class="courses-coming-soon">
        <div class="container courses-coming-soon-layout">
            <div>
                <p class="courses-eyebrow">GENESIS BLOCK <span>/</span> LEARNING</p>
                <h1>Courses are<br><span>coming soon.</span></h1>
                <p>We’re developing practical courses to help you build market knowledge, strengthen discipline and keep learning at your own pace.</p>
                <p class="courses-stay-tuned"><span aria-hidden="true"></span> Stay tuned for updates.</p>
                <div class="courses-actions">
                    <a class="courses-button" href="{{ route('blogs.index') }}">Explore the blog <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    <a class="courses-contact-link" href="{{ route('contact-us') }}">Contact us</a>
                </div>
            </div>
            <aside class="courses-note" aria-label="Course topics">
                <p>What we’re working toward</p>
                <ul>
                    <li>Market foundations</li>
                    <li>Technical analysis</li>
                    <li>Risk and discipline</li>
                </ul>
            </aside>
        </div>
    </section>
    @else
        <section class="courses-catalog">
            <div class="container">
                <header class="courses-catalog-heading">
                    <p class="courses-eyebrow">GENESIS BLOCK <span>/</span> LEARNING</p>
                    <h1>Courses for<br><span>steady progress.</span></h1>
                    <p>Explore our learning programs and choose a topic that fits where you are today.</p>
                </header>
                <div class="courses-grid">
                    @foreach ($courses as $course)
                        <article class="course-card">
                            @if ($course->image)
                                <img src="{{ asset('storage/' . ltrim($course->image, '/')) }}" alt="{{ $course->title }} course cover" loading="lazy">
                            @else
                                <div class="course-card-placeholder" aria-hidden="true"><i class="fas fa-book-open"></i></div>
                            @endif
                            <div class="course-card-content">
                                <span class="course-card-label">COURSE</span>
                                <h2>{{ $course->title }}</h2>
                                @if ($course->description)
                                    <p>{{ strip_tags($course->description) }}</p>
                                @endif
                                @if ($course->serviceDetails)
                                    <div class="course-card-detail">
                                        <h3>{{ $course->serviceDetails->title }}</h3>
                                        <p>{{ strip_tags($course->serviceDetails->description ?? '') }}</p>
                                    </div>
                                @endif
                                <a href="{{ route('contact-us') }}" class="courses-button">Ask about this course <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</main>
