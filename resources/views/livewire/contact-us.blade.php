<main class="contact-page">
    <section class="contact-hero">
        <div class="container contact-hero-layout">
            <div>
                <p class="contact-eyebrow">GENESIS BLOCK <span>/</span> CONTACT</p>
                <h1>Let’s start<br><span>a conversation.</span></h1>
                <p>Questions about Genesis Block, learning resources or upcoming courses? Reach out through one of the contact channels below.</p>
            </div>
            <div class="contact-hero-note">
                <span class="contact-note-mark" aria-hidden="true"><i class="fas fa-envelope"></i></span>
                <p>We’re here to help you find the right place to start.</p>
            </div>
        </div>
    </section>

    <section class="contact-content">
        <div class="container">
            @if ($departments->isNotEmpty())
                <div class="contact-departments">
                    @foreach ($departments as $department)
                        <article class="contact-department">
                            <span class="contact-department-icon" aria-hidden="true"><i class="fas {{ $department['icon'] }}"></i></span>
                            <div class="contact-department-content">
                                <h2>{{ $department['title'] }}</h2>
                                @if ($department['description'])
                                    <p class="contact-department-description">{{ $department['description'] }}</p>
                                @endif
                                <div class="contact-channel-list">
                                    @if ($department['email'])
                                        <a class="contact-channel" href="mailto:{{ $department['email'] }}">
                                            <span>Email</span><strong>{{ $department['email'] }}</strong><i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    @if ($department['phone'])
                                        <a class="contact-channel" href="tel:{{ preg_replace('/[^0-9+]/', '', $department['phone']) }}">
                                            <span>Phone</span><strong>{{ $department['phone'] }}</strong><i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    @if ($department['hours'])
                                        <div class="contact-channel contact-channel-static">
                                            <span>Availability</span><strong>{{ $department['hours'] }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="contact-empty-state">
                    <p class="contact-eyebrow">CONTACT DETAILS</p>
                    <h2>Our contact channels are being updated.</h2>
                    <p>Please check back soon for the latest support and course enquiry details.</p>
                </div>
            @endif

            @if ($companyDetails->isNotEmpty())
                <section class="contact-company" aria-labelledby="contact-company-title">
                    <div class="contact-company-heading">
                        <p class="contact-eyebrow">COMPANY DETAILS</p>
                        <h2 id="contact-company-title">Genesis Block</h2>
                    </div>
                    <dl class="contact-company-details">
                        @foreach ($companyDetails as $key => $detail)
                            <div>
                                <dt>{{ $detail['label'] }}</dt>
                                <dd>
                                    @if ($key === 'email')
                                        <a href="mailto:{{ $detail['value'] }}">{{ $detail['value'] }}</a>
                                    @elseif ($key === 'phone')
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $detail['value']) }}">{{ $detail['value'] }}</a>
                                    @elseif ($key === 'website')
                                        <a href="{{ $detail['value'] }}" target="_blank" rel="noopener noreferrer">{{ $detail['value'] }}</a>
                                    @else
                                        {{ $detail['value'] }}
                                    @endif
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                </section>
            @endif
        </div>
    </section>
</main>
