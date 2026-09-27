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
                            href="{{ route('about-us') }}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#resources">Resources</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#indicators">Indicators</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#blogs">Blogs</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}"
                            href="{{ route('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}"
                            href="{{ route('gallery') }}">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}"
                            href="{{ route('news') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact-us') ? 'active' : '' }}"
                            href="{{ route('contact-us') }}">Contact</a></li>
                </ul>
                <div class="navbar-actions">
                    <a href="{{ route('login') }}" class="navbar-login">Login</a>
                    <a href="{{ route('register') }}" class="navbar-register">Register</a>
                </div>
            </div>
        </div>
    </nav>
