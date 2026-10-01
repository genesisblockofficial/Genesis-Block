@php
    $socialSettings = \App\Models\SocialMediaSettings::query()->first();
    $whatsappUrl = $socialSettings?->whatsapp_url ?: 'https://wa.me/' . config('services.whatsapp.number');
@endphp
<footer class="site-footer">
    <div class="container site-footer-main">
        <div class="site-footer-brand">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="">
                <span class="brand-name">Genesis Block</span>
            </a>
            <p>Market education, indicator explainers and thoughtful context for independent learning.</p>
            <ul class="site-social-icons" aria-label="Social media platforms">
                <li>@if ($socialSettings?->youtube_url)<a href="{{ $socialSettings->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>@else<span role="img" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></span>@endif</li>
                <li>@if ($socialSettings?->telegram_url)<a href="{{ $socialSettings->telegram_url }}" target="_blank" rel="noopener" aria-label="Telegram"><i class="fab fa-telegram-plane" aria-hidden="true"></i></a>@else<span role="img" aria-label="Telegram"><i class="fab fa-telegram-plane" aria-hidden="true"></i></span>@endif</li>
                <li><a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                <li>@if ($socialSettings?->instagram_url)<a href="{{ $socialSettings->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>@else<span role="img" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></span>@endif</li>
                <li>@if ($socialSettings?->facebook_url)<a href="{{ $socialSettings->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>@else<span role="img" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></span>@endif</li>
                <li>@if ($socialSettings?->x_url)<a href="{{ $socialSettings->x_url }}" target="_blank" rel="noopener" aria-label="X"><svg class="site-x-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 4l16 16M20 4L4 20" /></svg></a>@else<span role="img" aria-label="X"><svg class="site-x-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 4l16 16M20 4L4 20" /></svg></span>@endif</li>
            </ul>
        </div>
        <div class="site-footer-links">
            <div><h2>Explore</h2><a href="{{ route('about-us') }}">About us</a><a data-auth-gate href="{{ route('courses.index') }}">Courses</a><a data-auth-gate href="{{ route('journal') }}">My Journal</a><a data-auth-gate href="{{ route('gallery') }}">Gallery</a><a data-auth-gate href="{{ route('team-members') }}">Team Members</a><a data-auth-gate href="{{ route('journey') }}">Journey</a></div>
            <div><h2>Learn</h2><a data-auth-gate href="{{ route('resources') }}">Resources</a><a data-auth-gate href="{{ route('indicators.index') }}">Indicators</a><a data-auth-gate href="{{ route('faqs') }}">FAQs</a><a href="{{ route('blogs.index') }}">Blogs</a><a data-auth-gate href="{{ route('news') }}">News</a></div>
            <div><h2>Connect</h2><a href="{{ route('contact-us') }}">Contact us</a><a href="{{ route('login') }}">Login</a></div>
        </div>
    </div>
    <div class="container site-footer-bottom"><span>&copy; {{ date('Y') }} Genesis Block</span><span>Educational content only. Not investment advice.</span></div>
</footer>
