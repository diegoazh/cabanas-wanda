<?php

namespace App\Http\Controllers;

use App\Cottage;
use App\Http\Requests\RequestRental;
use App\Http\Requests\RequestRentalFind;
use App\Http\Requests\RequestRentalStore;
use App\Passenger;
use App\Rental;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class RentalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administration = 0;
        $email = 0;

        if (Auth::check()) {
            if (Auth::user()->isAdmin() || Auth::user()->isEmployed()) {
                $administration = true;
                $email = Auth::user()->email;
            } else {
                $email = Auth::user()->email;
            }
        }

        Cookie::queue('info_one', $administration, 180, null, null, false, false); // el último parametro es importante sino la cookie no es accesible desde el cliente $httpOnly = true es el default
        Cookie::queue('info_two', $email, 180, null, null, false, false);

        return view('frontend.rentals-index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestRentalStore $request)
    {
        $rentals = [];

        try {

            DB::transaction(function () use ($request, &$rentals) {

                $info = $request->all();

                if (!$cliente = User::where('name', $info['name'])->where('lastname', $info['lastname'])->where('email', $info['email'])->first()) {

                    if(!$cliente = Passenger::where('name', $info['name'])->where('lastname', $info['lastname'])->where('email', $info['email'])->first()) {

                        throw new \Exception('No se ha encontrado ni usuario ni pasajero que corresponda a los datos brindados.', 404);

                    }

                }

                if (!$info['toRentals']) {

                    throw new \Exception('No se ha enviado la información con la o las cabañas que desea alquilar.', 404);

                }

                foreach ($info['toRentals'] as $toRental) {
                    $dateFrom = Carbon::createFromFormat('d/m/Y H:i:s', $info['dateFrom'] . '00:00:00');
                    $dateTo = Carbon::createFromFormat('d/m/Y H:i:s', $info['dateTo'] . '10:00:00')->addDay();
                    $cottage = Cottage::where('number', $toRental['number'])->where('name', $toRental['name'])->where('id', $toRental['id'])->first();

                    $rental = new Rental();

                    if (empty($cottages = Rental::cottageForNumber($cottage->number, false, $dateFrom->toDateString(), $dateTo->toDateString()))) {

                        throw new \Exception('La cabaña ya ha sido reservada.');

                    }

                    $rental->cottage_id = $cottage->id;
                    $rental->dateFrom = $dateFrom->toDateString();
                    $rental->dateTo = $dateTo->toDateString();
                    ($cliente->getTable() === 'users') ? $rental->user_id = $cliente->id : $rental->passenger_id = $cliente->id;
                    $rental->cottage_price = $cottage->price;
                    $rental->total_days = $dateFrom->diffInDays($dateTo);
                    $rental->dateReservationPayment = Carbon::now()->addDays(1)->toDateTimeString();
                    // Fix me: Agregar la promoción y el calculo de su descuento aquí.
                    $rental->deductions = 0;
                    $rental->finalPayment = ($rental->cottage_price * $rental->total_days) - $rental->deductions;
                    $rental->code_reservation = $rental->createCodeReservation();
                    $rental->save();
                    $rental->cottage;

                    array_push($rentals, $rental);
                }
            });

        } catch (\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error intentando realizar las reservas. Por favor verifique y reintente. Error: ' . $exception->getMessage() . ' Codigo: ' . $exception->getCode()], 500);

        }

        return response()->json(compact('rentals'), 200);
    }

    /**
     * Find the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find(RequestRentalFind $request)
    {
        $info = $request->only('reserva', 'dni', 'email');

        if ($info['reserva']) {

            if (!$reserva = Rental::where('code_reservation', $info['reserva'])
                ->where('dateFrom', '<=', Carbon::now()->toDateString())
                ->where('dateTo', '>=', Carbon::now()->toDateString())
                ->where('state', 'en curso')
                ->first()) {

                return response()->json(['error' => 'No encontramos una reserva activa a la fecha para los datos proporcionado.'], 404);

            }

            $owner = !empty($reserva->user_id) ? User::find($reserva->user_id) : Passenger::find($reserva->passenger_id);

            $token = JWTAuth::fromUser($owner);

        } else if ($info['dni'] && $info['email']) {

            if (!$user = User::where('dni', $info['dni'])->where('email', $info['email'])->first()) {

                if (!$passenger = Passenger::where('dni', $info['dni'])->where('email', $info['email'])->first()) {

                    return response()->json(['error' => 'No se encontraron ni usuarios ni pasajeros con los datos proporcionados.'], 404);

                }

            }

            if (!$reserva = Rental::where((isset($user) && !empty($user)) ? 'user_id' : 'passenger_id', (isset($user) && !empty($user)) ? $user->id : $passenger->id)
                ->where('dateFrom', '<=', Carbon::now()->toDateString())
                ->where('dateTo', '>=', Carbon::now()->toDateString())
                ->where('state', 'en curso')
                ->first()) {

                return response()->json(['error' => 'No encontramos una reserva activa a la fecha para el usuario proporcionado.'], 404);

            }

            $token = JWTAuth::fromUser(!empty($user) ? $user : $passenger);

        } else {

            return response()->json(['error' => 'No se proporcionaron datos para poder encontrar la reserva.'], 404);

        }

        $reserva->cottage;
        $reserva->user;
        $reserva->passenger;
        $reserva->promotion;
        $reserva->claims;

        foreach ($reserva->orders as $order) {

            foreach ($order->ordersDetail as $detail) {

                $detail->food;

            }

        }

        return response()->json(compact('reserva', 'token'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cottagesAvailables(RequestRental $request)
    {
        $info = $request->all();
        $cottages = null;

        // cambiamos las fechas con Carbon ya que sino nos da error al consultar en la DB.
        $info['dateFrom'] = Carbon::createFromFormat('d/m/Y', $info['dateFrom'])->toDateString();
        $info['dateTo'] = Carbon::createFromFormat('d/m/Y', $info['dateTo'])->toDateString();

        if ($info['isForCottage']) {

            $cottages = Rental::cottageForNumber($info['query'], $info['simple'], $info['dateFrom'], $info['dateTo']);

        } else {

            $cottages = Rental::cottageForCapacity($info['query'], $info['simple'], $info['dateFrom'], $info['dateTo']);

        }

        if (empty($cottages)) {

            $message = $info['isForCottage'] ? 'Lo sentimos la cabaña no está disponible en esa fecha. Por favor intenta con otra cabaña o con una fecha diferente.' : 'No tenemos cabañas disponibles en esa fecha para la capacidad indicada. Lo sentimos mucho, por favor prueba con otra fecha o varía la capacidad.';

            return response()->json(['title' => 'SIN DISPONIBILIDAD', 'error' => $message], 404);

        }

        return response()->json(compact('cottages'), 200);
    }

    public function rentalsForState($state)
    {
        if (!$rentals = DB::table('rentals')->select('dateFrom', 'dateTo', 'cottage_price', 'total_days', 'dateReservationPayment', 'state')
            ->where('state', $state)->orderBy('dateFrom', 'asc')->get()) {
            return response()->json(['error' => 'No hay reservas en estado: ' . $state], 404);
        }

        return response()->json(compact('rentals'), 200);
    }
}
