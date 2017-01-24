<?php

namespace App\Http\ViewComposers;

use App\User;
use App\Cottage;
use Illuminate\Contracts\View\View;

class AdminViewComposer
{
    public function compose(View $view)
    {
        $cantUsers = User::where('deleted_at', null)->count();
        $cantCottages = Cottage::where('deleted_at', null)->count();
        $view->with([
            'cantUsers' => $cantUsers,
            'cantCottages' => $cantCottages
        ]);
    }
}
