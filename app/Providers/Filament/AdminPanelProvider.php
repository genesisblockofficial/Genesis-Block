<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Genesis Block Admin')
            ->brandLogo(fn (): HtmlString => new HtmlString(
                '<span style="display:inline-flex;align-items:center;gap:.65rem;height:2.5rem">'
                .'<span style="display:inline-flex;width:2.35rem;height:2.35rem;align-items:center;justify-content:center;overflow:hidden;border:1px solid #d1d5db;border-radius:50%;background:#fff">'
                .'<img src="'.e(asset('images/logo.png')).'" alt="" style="width:155%;height:155%;max-width:none;object-fit:cover;object-position:center 38%;transform:scale(1.08)">'
                .'</span>'
                .'<span style="white-space:nowrap;font-size:1rem;font-weight:700">Genesis Block Admin</span>'
                .'</span>'
            ))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/logo.png'))
            ->passwordReset()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->collapsibleNavigationGroups()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
