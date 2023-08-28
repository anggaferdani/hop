<?php

namespace App\Providers;

use App\Models\Pendaftar;
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
        View::share('pendaftarCount', Pendaftar::where('status_approved', 'Belum Di Approved')->count());
    }
}
