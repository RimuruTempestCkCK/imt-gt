<?php

namespace App\Providers;

use App\Models\MenuItem;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $settings = Schema::hasTable('settings') ? Setting::pairs(true) : [];

        View::share('siteSettings', $settings);
        View::share('publicMenuItems', Schema::hasTable('menu_items')
            ? MenuItem::query()->where('location', 'header')->where('is_active', true)->orderBy('sort_order')->get()
            : collect());

        View::composer('*', function ($view): void {
            $view->with('currentLocale', app()->getLocale());
            $view->with('availableLocales', [
                'id' => 'Indonesia',
                'en' => 'English',
            ]);
        });
    }
}
