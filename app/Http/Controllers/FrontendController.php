<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Frontend;

class FrontendController extends Controller
{
    public function showHome()
    {
        $content = Frontend::where('deleted_at', null)->first();
        $carbon = new Carbon();
        $year = $carbon->year;

        return view('frontend.home')->with(compact('year', 'content'));
    }
}
