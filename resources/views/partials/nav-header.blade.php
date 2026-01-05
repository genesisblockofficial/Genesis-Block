    <!-- Header / Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.jpg') }}" alt="Images">
                <span>Trade</span><span>Walla</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about-us') }}"
                            href="{{ route('about-us') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}"
                            href="{{ route('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}"
                            href="{{ route('news') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact-us') ? 'active' : '' }}"
                            href="{{ route('contact-us') }}">Contact</a></li>
                </ul>
                <div class="d-flex ms-lg-3 mt-3 mt-lg-0">
                    <a href="{{ route('login') }}" class="btn btn-secondary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                </div>
            </div>
        </div>
    </nav>
