<?php

namespace App\Providers;

use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class ProductModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \App\Product::observe(ProductObserver::class);
    }
}
