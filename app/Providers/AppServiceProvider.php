<?php

namespace App\Providers;


use App\Models\Package;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        if(Schema::hasTable('packages'))
        {
            $packages=Package::all();
            // dd($events);
            View::share('packages',$packages);
        }
    }
}
