<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Tempat binding container / service khusus aplikasi
        // Contoh:
        // $this->app->singleton(MyService::class, fn () => new MyService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Jika pakai MySQL/MariaDB lama, aktifkan ini agar tidak error index length
        // Schema::defaultStringLength(191);

        // Laravel default pakai Tailwind untuk pagination.
        // Jika kamu pakai Bootstrap, aktifkan baris di bawah:
        // Paginator::useBootstrap();

        // Paksa HTTPS di production (disarankan jika sudah pakai SSL)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
