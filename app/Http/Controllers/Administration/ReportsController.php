<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Order;
use App\Rental;
use Carbon\Carbon;
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
            $rental->promotion;
            $rental->claims;

        }

        return response()->json(compact('rentals'), 200);

    }

    public function findOrdersForRental(Request $request)
    {
        $info = $request->all();
        $rentalsQuery = [];

        if ($info['filterFor'] === 'year') {
            $minDate = Carbon::createFromFormat('Y-m-d', $info['minDate'])->startOfYear()->toDateString();
            $maxDate = Carbon::createFromFormat('Y-m-d', $info['maxDate'])->endOfYear()->toDateString();
        } else if ($info['filterFor'] === 'month') {
            $minDate = Carbon::createFromFormat('Y-m-d', $info['minDate'])->startOfMonth()->toDateString();
            $maxDate = Carbon::createFromFormat('Y-m-d', $info['maxDate'])->endOfMonth()->toDateString();
        } else {
            $minDate = Carbon::createFromFormat('Y-m-d', $info['minDate'])->startOfMonth()->toDateString();
            $maxDate = Carbon::createFromFormat('Y-m-d', $info['maxDate'])->endOfMonth()->toDateString();
        }

        Rental::whereBetween('dateFrom', [$minDate, $maxDate])
            ->whereBetween('dateTo', [$minDate, $maxDate])
            ->where('state', $info['state'])
            ->chunk(60, function ($rentals) use (&$rentalsQuery) {

            foreach ($rentals as $rental) {

                foreach ($rental->orders as $order) {

                    foreach ($order->ordersDetail as $detail) {

                        $detail->food;

                    }

                }

            }

            $rentalsQuery = array_merge($rentalsQuery, $rentals->toArray());
        });

        return response()->json(['orders' => $rentalsQuery], 200);
    }
}
