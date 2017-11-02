<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLiquidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use JWTAuth;

class LiquidationController extends Controller
{
    /**
     * Display a final liquidation of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liquidation()
    {
        $token = null;

        if (Auth::check()) {
            if (Auth::user()->isAdmin() || Auth::user()->isEmployed()) {

                $token = JWTAuth::fromUser(Auth::user());

            }
        }

        !$token ? Cookie::forget('info_one') : Cookie::queue('info_one', $token, 180, null, null, false, false);;

        return view('frontend.rentals-liquidation');
    }

    /**
     * Total debt settlement
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finalLiquidation(RequestLiquidation $request)
    {
        $info = $request->only('rental_id', 'email', 'password');
        $user = User::where('email', $info['email'])
            ->where('password', Hash::make($info['password']))
            ->where('type', 'admin')
            ->orWhere('type', 'sysadmin')
            ->first();
        $rental = Rental::find($info['rental_id']);
        $rental->cottage;
        $rental->user;
        $rental->passenger;
        $rental->promotion;
        $rental->claims;

        foreach ($rental->orders as $order) {

            foreach ($order->ordersDetail as $detail) {

                $detail->food;

            }

        }
    }
}
