<?php

namespace App\Providers;

use App\Models\ActivityManajemen;
use App\Models\HangoutPlace;
use App\Models\Pendaftar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::share('pendaftarCount', Pendaftar::where('status_approved', 'Belum Di Approved')->where('status_aktif', 'Aktif')->count());
        View::share('foodAndBeverageCount', HangoutPlace::where('status_approved', 'Belum Di Approved')->where('status', 'Food And Beverage')->where('status_aktif', 'Aktif')->count());
        View::share('lodgingCount', HangoutPlace::where('status_approved', 'Belum Di Approved')->where('status', 'Lodging')->where('status_aktif', 'Aktif')->count());
        View::share('publicAreaCount', HangoutPlace::where('status_approved', 'Belum Di Approved')->where('status', 'Public Area')->where('status_aktif', 'Aktif')->count());
        View::share('activityManajemenCount', ActivityManajemen::where('status_approved', 'Belum Di Approved')->where('status_aktif', 'Aktif')->count());
    }
}
