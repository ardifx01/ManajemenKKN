<?php

namespace App\Providers;

use App\Models\ProfileKKN;
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
        View::composer('layouts.app', function ($view) {
            $profile = ProfileKKN::first(); // contoh ambil data desa
            $view->with('profile', $profile);
        });
    }
}
