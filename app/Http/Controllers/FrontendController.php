<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function getHome()
    {
      return view('frontend.home');
    }
}
