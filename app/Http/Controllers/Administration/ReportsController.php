<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use JWTAuth;

class ReportsController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->isAdminOrEmployed()) {

            $token = JWTAuth::fromUser(Auth::user());

        }

        Cookie::queue('info_one', $token, 180, null, null, false, false);

        return view('backend.reports');
    }

    public function rentalsForMonth() {

        $rentals = Rental::orderBy('cottage_id')->orderBy('dateFrom')->get();

        foreach ($rentals as $rental) {

            $rental->cottage;
            $rental->user;
            $rental->passenger;

        }

        return response()->json(compact('rentals'), 200);

    }
}
