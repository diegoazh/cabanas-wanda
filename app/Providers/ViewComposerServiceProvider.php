<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
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
                'backend.home-page',
                'backend.cottages',
                'backend.cottage-create',
                'backend.users'
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
