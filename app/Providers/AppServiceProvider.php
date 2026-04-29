<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
  public function register(): void
{
    // Tambahkan baris ini agar fungsi Vite dan Upload File mencari ke public_html/loker
    // Commented out for local development - uncomment for production deployment
    // $this->app->usePublicPath(base_path('../public_html/loker'));
}


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
