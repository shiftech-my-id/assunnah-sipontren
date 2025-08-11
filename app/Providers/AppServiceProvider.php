<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);

        view()->composer('*', function ($view) {
            $modules = config('app-modules');

            // Ambil segmen pertama dari URL
            $firstSegment = Request::segment(1);

            // Cari modul berdasarkan prefix
            $activeModule = collect($modules)
                ->first(fn($m) => $m['prefix'] === $firstSegment);

            $view->with([
                'MODULE_NAME' => $activeModule['name'] ?? '',
                'MODULE_DISPLAY_NAME' => $activeModule['display_name'] ?? '',
            ]);
        });
    }
}
