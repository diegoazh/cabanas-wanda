<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminMenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            'App\Http\ViewComposers\AdminViewComposer' => [
                'backend.panel',
                'backend.cottage-create',
                'backend.users',
                'backend.cottages'
            ],
            'App\Http\ViewComposers\RegisterViewComposer' => 'auth.register'
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
