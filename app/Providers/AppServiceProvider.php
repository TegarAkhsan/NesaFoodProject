<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Stand;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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
    public function boot()
    {
        View::composer('*', function ($view) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('stands')) {
                    $view->with('stands', Stand::all());
                } else {
                    $view->with('stands', collect());
                }
            } catch (\Exception $e) {
                $view->with('stands', collect());
            }
        });
    }
}
