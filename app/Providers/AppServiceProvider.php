<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
            $unreadNotificationsCount = 0;
            if (auth()->guard("web")->check()) {
                $unreadNotificationsCount = auth()->guard("web")->user()->unreadNotifications->count();
            }
            $view->with([
                "unreadNotificationsCount" => $unreadNotificationsCount
            ]);
        });
    }
}
