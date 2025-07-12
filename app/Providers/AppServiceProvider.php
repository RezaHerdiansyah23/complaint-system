<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        // Tambahkan ini
        Route::middleware('web')->group(function () {
            Route::get('/redirect', function () {
                if (auth()->check()) {
                    $role = auth()->user()->role;

                    return match ($role) {
                        'admin' => redirect('/admin'),
                        'noc' => redirect('/noc'),
                        default => redirect('/dashboard'),
                    };
                }

                return redirect('/login');
            });
        });
    }
}
