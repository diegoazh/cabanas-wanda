<?php

namespace App\Http\ViewComposers;

use App\Country;
use Illuminate\Contracts\View\View;

class RegisterViewComposer
{
    public function compose(View $view)
    {
        $countries = Country::orderBy('id', 'asc')->get();
        $view->with('countries', $countries);
    }
}