<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        Inertia::share([
            'auth.user' => fn () => Auth::user() ? [
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'role' => strtolower(Auth::user()->role ?? ''),
            ] : null,
        ]);
    }
}
