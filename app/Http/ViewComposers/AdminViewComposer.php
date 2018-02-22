<?php

namespace App\Http\ViewComposers;

use App\Claim;
use App\Promotion;
use App\User;
use App\Cottage;
use Illuminate\Contracts\View\View;

class AdminViewComposer
{
    public function compose(View $view)
    {
        $cantUsers = User::all()->count();
        $cantCottages = Cottage::all()->count();
        $cantPromotions = Promotion::all()->count();
        $cantClaims = Claim::all()->count();

        $view->with([
            'cantUsers' => $cantUsers,
            'cantCottages' => $cantCottages,
            'cantPromotions' => $cantPromotions,
            'cantClaims' => $cantClaims
        ]);
    }
}
