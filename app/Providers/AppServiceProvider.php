<?php

namespace App\Providers;

use App\Models\Order;
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
        view()->composer(['admin.layouts.sidebar'], function ($view) 
        {
            $pending_order = Order::whereStatus('1')->count();
            $view->with('pending_order', $pending_order ?? 0 );    
        });
    }
}
