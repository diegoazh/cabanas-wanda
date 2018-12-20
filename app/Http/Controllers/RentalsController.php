<?php

namespace App\Http\Controllers;

use App\Cottage;
use App\Devolution;
use App\Events\NewCodeReservationEvent;
use App\Events\NewRentalEvent;
use App\Events\RentalUpdateEvent;
use App\Http\Requests\RequestRental;
use App\Http\Requests\RequestRentalFind;
use App\Http\Requests\RequestRentalStore;
use App\Http\Requests\RequestRentalUpdate;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('frontend.rentals-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RequestRentalStore  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestRentalStore $request)
    {
        $rental = null;

        try {

            DB::transaction(function () use ($request, &$rental) {

                $info = $request->all();

                if (!$cliente = User::where('name', $info['name'])->where('lastname', $info['lastname'])->where('email', $info['email'])->first()) {

                    throw new \Exception('No se ha encontrado ni usuario ni pasajero que corresponda a los datos brindados.', 404);

                }

                if (!$info['toRentals']) {

                    throw new \Exception('No se ha enviado la información con la o las cabañas que desea alquilar.', 404);

                }

                foreach ($info['toRentals'] as $toRental) {
                    $dateFrom = Carbon::createFromFormat('d/m/Y H:i:s', $info['dateFrom'] . '00:00:00');
                    $dateTo = Carbon::createFromFormat('d/m/Y H:i:s', $info['dateTo'] . '10:00:00')->addDay();
                    $cottage = Cottage::where('number', $toRental['number'])->where('name', $toRental['name'])->where('id', $toRental['id'])->first();

                    if (!empty(Rental::notAvailable($cottage->number, $dateFrom->toDateString(), $dateTo->toDateString()))) {

                        throw new \Exception('La cabaña ya ha sido reservada.');

                    }

                    $code = Rental::createCodeReservation($cottage->id, $cliente->id);

                    $rental = Rental::create([
                        'cottage_id' => $cottage->id,
                        'dateFrom' => $dateFrom->toDateString(),
                        'dateTo' => $dateTo->toDateString(),
                        'user_id' => $cliente->id,
                        'cottage_price' => $cottage->price,
                        'total_days' => $dateFrom->diffInDays($dateTo),
                        'dateReservationPayment' => Carbon::now()->addDays(1)->toDateTimeString(),
                        // Fix me: Agregar la promoción y el calculo de su descuento aquí.
                        'deductions' => 0,
                        'finalPayment' => ($cottage->price * $dateFrom->diffInDays($dateTo)) - 0, // 0 is deductions fix this
                       'code_reservation' => $code
                    ]);

                    $rental->cottage;
                    $rental->user;
                    $rental->code = $code;

                    event(new NewRentalEvent($rental));
                }
            });

        } catch (\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error intentando realizar las reservas. Por favor verifique y reintente. Error: ' . $exception->getMessage() . ' Codigo: ' . $exception->getCode()], 500);

        }

        return response()->json(compact('rental'), 200);
    }

    /**
     * Find the specified resource in storage by hes id.
     *
     * @param  Number  $id
     * @return \Illuminate\Http\Response
     */
    public function findForId($id)
    {
        if (!$reserva = Rental::find($id)) {

            return response()->json(['error' => 'No hemos localizado la reserva'], 404);

        }

        $reserva->cottage;
        $reserva->user;
        $reserva->promotion;
        $reserva->claims;

        foreach ($reserva->orders as $order) {

            foreach ($order->ordersDetail as $detail) {

                $detail->food;

            }

        }

        return response()->json($reserva, 200);
    }

    /**
     * Find the specified resource in storage.
     *
     * @param  \App\Http\Requests\RequestRentalFind  $request
     * @return \Illuminate\Http\Response
     */
    public function find(RequestRentalFind $request)
    {
        $info = $request->only('reserva', 'dni', 'email', 'fromNow');

        if (isset($info['reserva']) && $info['reserva']) {

            if (isset($info['fromNow']) && $info['fromNow']) {

                if (!$reserva = Rental::where('code_reservation', sha1($info['reserva']))
                    ->where('dateFrom', '>=', Carbon::now()->toDateString())
                    ->where('state', '<>', 'finalizada')
                    ->where('state', '<>', 'cancelada')
                    ->first()) {

                    return response()->json(['error' => 'No encontramos la reserva asociada a los datos proporcionado.'], 404);

                }

                $reserva->cottage;

                return response()->json($reserva, 200);
            }

            if (!$reserva = Rental::where('code_reservation', sha1($info['reserva']))
                ->where('dateFrom', '<=', Carbon::now()->toDateString()) // Se modifica solo con 48hs o más de anticipación
                ->where('dateTo', '>=', Carbon::now()->toDateString())
                ->where('state', 'en_curso')
                ->first()) {

                return response()->json(['error' => 'No encontramos una reserva activa a la fecha para los datos proporcionado.'], 404);

            }

            $owner = !empty($reserva->user_id) ? User::find($reserva->user_id) : null;

            $owner ? $token = JWTAuth::fromUser($owner) : null;

        } else if (isset($info['dni']) && $info['dni'] && isset($info['email']) && $info['email']) {

            if (!$user = User::where('dni', $info['dni'])->where('email', $info['email'])->first()) {

                return response()->json(['error' => 'No se encontraron ni usuarios ni pasajeros con los datos proporcionados.'], 404);

            }

            if (!$reserva = Rental::where('user_id', $user->id)
                ->where('dateFrom', '<=', Carbon::now()->toDateString())
                ->where('dateTo', '>=', Carbon::now()->toDateString())
                ->where('state', 'en curso')
                ->first()) {

                return response()->json(['error' => 'No encontramos una reserva activa a la fecha para el usuario proporcionado.'], 404);

            }

            $token = JWTAuth::fromUser($user);

        } else {

            return response()->json(['error' => 'No se proporcionaron datos para poder encontrar la reserva.'], 404);

        }

        $reserva->cottage;
        $reserva->user;
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
     * @param  \App\Http\Requests\RequestRentalUpdate  $request
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestRentalUpdate $request, $id)
    {
        $hasChanges = false;
        $info = $request->only(['description', 'state', 'side']);

        if (!$rental= Rental::find($id)) {

            return response()->json(['error' => 'No hemos localizado la reserva solicitada. Verifique y reintente.'], 404);

        }

        if ($info['description'] && $info['description'] !== $rental->description) {

            $rental->description = $info['description'];
            $hasChanges = true;

        }

        if ($info['state'] && $info['state'] !== $rental->state) {

            $rental->state = $info['state'];
            $hasChanges = true;

        }

        if ($hasChanges) {

            try {
                DB::transaction(function () use ($info, $rental) {

                    $dF = Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateFrom . ' 10:00:00');
                    $can = Carbon::now();

                    if ($info['state'] === 'cancelada') {

                        if ($info['side'] || !$info['side'] && $can->diffInDays($dF) >= 2) {

                            $devolution = new Devolution([
                                'rental_id' => $rental->id,
                                'from_admin' => isset($info['side']) && $info['side'] ? $info['side'] : false
                            ]);

                            $devolution->save();

                        }

                    }

                    $rental->save();

                });

            } catch (\Exception $exception) {

                return response()->json(['error' => 'Ha ocurrido un error intentando actualizar la información. Verifiquelo y reintente. Mensaje: ' . $exception->getMessage() . ' - Código: ' . $exception->getCode()], 500);

            }

            return response()->json(['message' => 'La reserva se actualizó correctamente.'], 200);
        }

        return response()->json(['message' => 'Reserva sin cambios. No se llevó acabo ninguna actualización.'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    public function updateWithCode(Request $request, $id)
    {
        $hasChanges = false;
        $info = $request->only(['cottage_id', 'dateFrom', 'dateTo', 'state']);
        $dateFrom = $info['dateFrom'] ? Carbon::createFromFormat('d/m/Y H:i:s', $info['dateFrom'] . '00:00:00') : null;
        $dateTo = $info['dateTo'] ? Carbon::createFromFormat('d/m/Y H:i:s', $info['dateTo'] . '10:00:00')->addDay() : null;
        $cottage = Cottage::find($info['cottage_id']);

        if (!$rental= Rental::find($id)) {

            return response()->json(['error' => 'No hemos localizado la reserva solicitada. Verifique y reintente.'], 404);

        }

        if ($info['cottage_id'] && $rental->cottage_id !== $info['cottage_id']) {

            $rental->cottage_id = $cottage->id;
            $hasChanges = true;

        }

        if (isset($dateFrom) || isset($dateTo)) {

            if ($rental->dateFrom !== $dateFrom->toDateString()) $rental->dateFrom = $dateFrom->toDateString();
            if ($rental->dateTo !== $dateTo->toDateString()) $rental->dateTo = $dateTo->toDateString();
            $rental->cottage_price = $cottage->price;
            $rental->total_days = $dateFrom->diffInDays($dateTo);
            Carbon::now()->addDays(1)->gte($dateFrom) ? null : $rental->dateReservationPayment = Carbon::now()->addDays(1)->toDateTimeString();
            // TODO (Diego) Fix me: Agregar la promoción y el calculo de su descuento aquí.
            $rental->deductions = 0;
            $rental->finalPayment = ($rental->cottage_price * $rental->total_days) - $rental->deductions;
            $hasChanges = true;

        }

        if ($info['state'] && $rental->state !== $info['state']) {

            $rental->state = $info['state'];
            $hasChanges = true;

        }

        if (!$hasChanges) {

            return response()->json(['title' => 'Sin modificaciones', 'message' => 'Reserva sin cambios. No se llevó acabo ninguna modificación.'], 200);

        } else {

            $code = Rental::createCodeReservation($rental->cottage_id, $rental->user_id);
            $rental->code_reservation = $code;
            $rental->save();
            $rental->cottage;
            $rental->user;
            $rental->code = $code;

        }

        event(new RentalUpdateEvent($rental));

        return response()->json(['message' => 'La reserva se actualizó correctamente.', 'rental' => $rental], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$rental = Rental::find($id)) {

            return response()->json(['error' => 'La reserva buscada no existe o ya fué eliminada.'], 404);

        }

        $rental->delete();

        return response()->json(['message' => 'La reserva fué eliminada correctamente.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\RequestRental  $request
     * @return \Illuminate\Http\Response
     */
    public function cottagesAvailables(RequestRental $request)
    {
        $info = $request->all('dateFrom', 'dateTo', 'update', 'cottage_id', 'rental_id');
        $cottages = null;

        // cambiamos las fechas con Carbon ya que sino nos da error al consultar en la DB.
        $dateFrom = Carbon::createFromFormat('d/m/Y', $info['dateFrom']);
        $dateTo = Carbon::createFromFormat('d/m/Y', $info['dateTo']);

        if ($dateTo->lt($dateFrom)) {

            return response()->json(['title' => 'RANGO DE FECHAS INVALIDO', 'error' => 'La fecha final (o fecha hasta) no puede ser menor que la fecha de inicio (o fecha desde). Por favor corrija esto y reintente. Muchas gracias.'], 500);

        }

        if ($info['update']) {

            if (!empty($rentals = Rental::checkForExtendsDate($dateFrom->toDateString(), $dateTo->toDateString(), $info['cottage_id'], $info['rental_id']))) {

                $cottage = Cottage::find($info['cottage_id']);

                return response()->json(compact($cottage), 200);

            }

        }

        if (!empty($cottages = Rental::availables($dateFrom->toDateString(), $dateTo->toDateString()))) {

            $message = 'Lo sentimos mucho pero no tenemos cabañas disponibles en esas fechas.';

            return response()->json(['title' => 'SIN DISPONIBILIDAD', 'error' => $message], 404);

        }

        return response()->json(compact('cottages'), 200);
    }

    public function rentalsForState(Request $request, $state, $results)
    {
        $quantity = $results > 100 ? 100 : $results;

        if (!empty($rentals = DB::table('rentals')->select('id', 'dateFrom', 'dateTo', 'cottage_price', 'total_days', 'dateReservationPayment', 'state')
            ->where('state', $state)->orderBy($request->order, $request->sent)->paginate($quantity))) {

            return response()->json(['error' => 'No hay reservas en estado: ' . $state], 404);

        }

        return response()->json($rentals, 200);
    }

    public function updateRentalCode(Request $request)
    {
        $this->validate($request, [
            'id' => 'integer'
        ], [
            'id.integer' => 'El id debe ser un número entero.'
        ]);

        if (!$id = $request->input('id', null)) {

            return response()->json(['message' => 'No hemos encontrado la reserva solicitada.'], 404);

        }

        $rental = Rental::find($id);
        $code = Rental::createCodeReservation($rental->cottage_id, $rental->user_id);
        $rental->code_reservation = $code;
        $rental->save();
        $rental->user;

        event(new NewCodeReservationEvent($rental, $code));

        return response()->json(compact('code'), 200);
    }
}
