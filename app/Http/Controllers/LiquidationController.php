<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLiquidation;
use App\Rental;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
     * @param  \App\Http\Requests\RequestLiquidation $request
     * @return \Illuminate\Http\Response
     */
    public function finalLiquidation(RequestLiquidation $request)
    {
        $info = $request->only('rental_id', 'email', 'password');

        if (!$rental = Rental::find($info['rental_id'])) {

            return response()->json(['error' => 'No pudimos localizar la reserva solicitada. Por favor verifique la misma y reintente o avise al Administrador del sistema. Muchas gracias.']);

        }

        $rental->cottage;
        $rental->user;
        $rental->promotion;
        $rental->claims;

        foreach ($rental->orders as $order) {

            foreach ($order->ordersDetail as $detail) {

                $detail->food;

            }

        }

        if (!$user = User::where('email', $info['email'])
            ->where('password', Hash::make($info['password']))
            ->where('type', 'admin')
            ->orWhere('type', 'sysadmin')
            ->first()) {

            return response()->json(['error' => 'El usuario no está habilitado para realizar está operación.'], 500);

        }

        try {

            DB::transaction(function () use($rental, $user) {

                $rental->state = 'finalizada';
                $rental->dateReservationPayment = Carbon::now()->toDateTimeString();
                $monto = (double) ($rental->cottage_price * $rental->total_days);
                $reserva = (double) (30/100 * $monto);
                $rental->finalPayment = $monto - $reserva - (double) $rental->deductions;

                foreach ($rental->orders as $order) {

                    $order->state = 'pagado';
                    $order->closed_for = $user->id;
                    $order->save();

                }

                $rental->save();

            });

        } catch(\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error intentando realizar las operación de liquidación. Verifique y reintente. Mensaje: ' . $exception->getMessage() . ' - Código: ' . $exception->getCode()], 500);

        }

        return response()->json(['message' => 'La liquidación se realizó correctamente.'], 200);
    }
}
