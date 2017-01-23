<?php

namespace App\Http\ViewComposers;

use App\User;
use Illuminate\Contracts\View\View;

class AdminViewComposer
{
    public function compose(View $view)
    {
        $cantUsers = User::where('deleted_at', null)->count();
        $view->with(['cantUsers' => $cantUsers]);
    }
}
