<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('backend.panel');
    }

    public function homePage()
    {
        $a = '<h1>Hola</h1>';
        return view('backend.home-page')->with('a', $a);
    }
}
