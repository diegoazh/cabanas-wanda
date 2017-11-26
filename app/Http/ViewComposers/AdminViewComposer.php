<?php

namespace App\Http\ViewComposers;

use App\Claim;
use App\Passenger;
use App\Promotion;
use App\User;
use App\Cottage;
use Illuminate\Contracts\View\View;

class AdminViewComposer
{
    public function compose(View $view)
    {
        $cantUsers = User::all()->count();
        $canPassengers = Passenger::all()->count();
        $cantCottages = Cottage::all()->count();
        $canPromotions = Promotion::all()->count();
        $canClaims = Claim::all()->count();

        $view->with([
            'cantUsers' => $cantUsers,
            'canPassengers' => $canPassengers,
            'cantCottages' => $cantCottages,
            'canPromotions' => $canPromotions,
            'canClaims' => $canClaims
        ]);
    }
}
