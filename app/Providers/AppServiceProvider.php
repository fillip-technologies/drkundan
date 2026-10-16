<?php

namespace App\Providers;

use App\Support\Navigation;
use App\Support\ServiceCatalog;
use App\Support\SiteConfig;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SiteConfig::class);
        $this->app->singleton(ServiceCatalog::class);
        $this->app->scoped(Navigation::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Clinic contact details (resources/data/site.json) for every view as $site.
        View::composer('*', fn ($view) => $view->with('site', $this->app->make(SiteConfig::class)));
    }
}
