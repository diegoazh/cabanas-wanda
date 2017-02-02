<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function showHome()
    {
        $carbon = new Carbon();
        $year = $carbon->year;
        return view('frontend.home')->with('year', $year);
    }
}
