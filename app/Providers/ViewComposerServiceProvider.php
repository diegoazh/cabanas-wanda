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
                'backend.cottages',
                'backend.cottage-create',
                'backend.foods',
                'backend.frontend',
                'backend.panel',
                'backend.promotions-create',
                'backend.users',
            ],
            'App\Http\ViewComposers\RegisterViewComposer' => 'auth.register',
            'App\Http\ViewComposers\FooterFrontViewComposer' => [
                'auth.login',
                'auth.register',
                'auth.registered',
                'auth.new-email-confirmation',
                'auth.passwords.email',
                'auth.passwords.reset',
                'frontend.cottages-index',
                'frontend.cottages-show',
                'frontend.home',
                'frontend.order-index',
                'frontend.our-location',
                'frontend.profile-edit',
                'frontend.rentals-index',
                'frontend.rentals-liquidation',
                'frontend.tourist-attractions',
            ]
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
