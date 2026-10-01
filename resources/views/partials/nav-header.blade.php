    <!-- Header / Navigation Bar -->
    <nav class="navbar navbar-expand-xxl navbar-dark" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}" aria-label="Genesis Block home">
                <img src="{{ asset('images/logo.png') }}" alt="Genesis Block logo">
                <span class="brand-name">Genesis Block</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about-us') ? 'active' : '' }}"
                            href="{{ route('about-us') }}">About Us</a></li>
                            <li class="nav-item"><a data-auth-gate class="nav-link {{ request()->routeIs('resources') ? 'active' : '' }}"
                                href="{{ route('resources') }}">Resources</a></li>
                        <li class="nav-item"><a data-auth-gate class="nav-link {{ request()->routeIs('indicators.*') ? 'active' : '' }}"
                            href="{{ route('indicators.index') }}">Indicators</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}"
                            href="{{ route('blogs.index') }}">Blogs</a></li>
                        <li class="nav-item"><a data-auth-gate class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}"
                            href="{{ route('courses.index') }}">Courses</a></li>
                    <li class="nav-item"><a data-auth-gate class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}"
                            href="{{ route('gallery') }}">Gallery</a></li>
                    <li class="nav-item"><a data-auth-gate class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}"
                            href="{{ route('news') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact-us') ? 'active' : '' }}"
                            href="{{ route('contact-us') }}">Contact Us</a></li>
                </ul>
                <div class="navbar-actions">
                    @auth
                        <a href="{{ route('account') }}" class="navbar-profile-avatar"
                            aria-label="Open {{ auth()->user()->name }}'s profile"
                            title="{{ auth()->user()->name }}">
                            {{ auth()->user()->initials() }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="get-started-button navbar-register group/button inline-flex shrink-0 cursor-pointer items-center justify-center bg-clip-padding font-medium whitespace-nowrap transition-all outline-none select-none focus-visible:border-ring focus-visible:ring-3 focus-visible:ring-ring/50 active:not-aria-[haspopup]:translate-y-px disabled:pointer-events-none aria-invalid:border-destructive aria-invalid:ring-3 aria-invalid:ring-destructive/20 dark:aria-invalid:border-destructive/50 dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 border-2 border-transparent bg-brand-blue text-brand-primary-text hover:bg-brand-hover active:bg-brand-pressed active:border-brand-primary-bg-3 disabled:border-transparent disabled:bg-brand-disabled-bg disabled:text-brand-disabled-text disabled:opacity-100 h-9 gap-1 body-b3-medium rounded-xl px-4 py-2.5">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
