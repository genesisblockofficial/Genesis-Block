<main class="account-page">
    <section class="account-hero">
        <div class="container account-hero-inner">
            <div>
                <p class="account-eyebrow">GENESIS BLOCK <span>/</span> PROFILE</p>
                <h1>Account details</h1>
                <p>Keep your personal details up to date for indicator access and future courses.</p>
            </div>
            <a class="account-logout" href="{{ route('account') }}">Back to profile <i class="fas fa-arrow-left" aria-hidden="true"></i></a>
        </div>
    </section>

    <section class="account-content">
        <div class="container">
            <form class="account-profile-form" wire:submit="updateProfileInformation">
                @if (session('status') === 'profile-updated')
                    <div class="account-form-status">Profile updated successfully.</div>
                @endif
                @if ($errors->any())
                    <div class="account-form-error">{{ $errors->first() }}</div>
                @endif
                <div class="account-form-grid">
                    <div class="account-form-field"><label for="profile-name">Full name</label><input id="profile-name" type="text" wire:model="name" required></div>
                    <div class="account-form-field"><label for="profile-email">Email address</label><input id="profile-email" type="email" wire:model="email" required></div>
                </div>
                <div class="account-form-actions"><button class="account-save-button" type="submit">Save changes <i class="fas fa-arrow-right" aria-hidden="true"></i></button></div>
            </form>
        </div>
    </section>
</main>
