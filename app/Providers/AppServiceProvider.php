<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Statamic\Facades\GlobalSet;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //* Shares all global statamic data with all Blade templates in the application.
        View::composer('*', function ($view) {
            GlobalSet::all()->each(fn ($set) => $view->with($set->handle(), $set->inCurrentSite()));
        });
    }
}
