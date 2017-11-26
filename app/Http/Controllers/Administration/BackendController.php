<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use JWTAuth;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPanel()
    {
        $administration = 0;
        $email = 0;

        if (Auth::check()) {
            if (Auth::user()->isAdmin()) { // || Auth::user()->isEmployed()
                $administration = JWTAuth::fromUser(Auth::user());
                $email = Auth::user()->email;
            } else {
                $email = Auth::user()->email;
            }
        }

        $administration ? Cookie::queue('info_one', $administration, 180, null, null, false, false) : null; // el último parametro es importante sino la cookie no es accesible desde el cliente $httpOnly = true es el default
        Cookie::queue('info_two', $email, 180, null, null, false, false);

        return view('backend.panel');
    }

}
