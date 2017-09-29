<?php

namespace App\Http\Controllers;

use App\Cottage;
use App\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = 0;

        if (Auth::check()) {
            if (Auth::user()->isAdmin() || Auth::user()->isEmployed()) {
                $administration = true;
            } else {
                $user = !empty(Auth::user()->dni) ? Auth::user()->dni : (!empty(Auth::user()->passport) ? Auth::user()->passport : Auth::user()->email);
            }
        }

        return view('frontend.rentals')->with(compact('administration', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental $rental)
    {
        //
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

    public function basicInfo(Request $request)
    {
        $cottages = Cottage::where('state', '!=', 'disabled')->orderBy('number')->get();

        return response()->json(compact('cottages'), 200);
    }

    public function forCapacity(Request $request)
    {
        $info = $request->all();

        // cambiamos las fechas con Carbon ya que sino nos da error al consultar en la DB.
        $info['dateFrom'] = Carbon::createFromFormat('d/m/Y', $info['dateFrom'])->toDateString();
        $info['dateTo'] = Carbon::createFromFormat('d/m/Y', $info['dateTo'])->toDateString();

        $resto = 0; // esta variable la usaremos para saber si además del cupo necesitamos otra cabaña o si la cantidad es menor a 5

        if (isset($info['capacity']) && $info['capacity'] >= 5) { // consultamos si la capacidad ha sido proporcionada y si es mayor a 5

            $necesarias = $info['capacity'] / 5; // obtenemos la cantidad de cabañas necesarias para 5 personas
            $resto = $info['capacity'] % 5; // obtenemos los ocupantes que faltan para una cabaña de 4 personas o menos

            // pedimos que nos traiga todas las cabañas cuyo id no este entre los ids devueltos por la subconsulta.
            $cottages = Cottage::whereNotIn('id', function ($query) use ($info) {
                // en la sub consulta pedimos todos los id de cabañas que han sido reservadas entre las fechas elegidas por el usuario
                // de esta forma evitamos superposición de reservas.
                $query->select('cottage_id')
                    ->from(with(new Rental)->getTable())
                    ->whereBetween('from', [$info['dateFrom'], $info['dateTo']])
                    ->whereBetween('to', [$info['dateFrom'], $info['dateTo']]);
            })->where('accommodation', '=', 5) // además indicamos que las cabañas elegidas deben ser de 5 personas
                ->limit($necesarias) // limitamos los resultados a la cantidad de cabañas necesaria
                ->get()->toArray();

        } else if (isset($info['capacity'])) { // consultamos si capacidad esta seteada para evitar errores

            $resto = $info['capacity'];

        } else { // si no se envió la capacidad enviamos el error 404

            return response()->json(['error' => 'Debe enviar la cantidad de ocupantes para hacer la consulta. Por favor reintente.'], 404);

        }

        if ($resto) { // si hay un resto o la capacidad es menor a 5 necesitamos una cabaña de 4 personas

            // la consulta es igual pero pedimos una e indicamos que debe ser para menos de 5 personas
            $otherCottage = Cottage::whereNotIn('id', function ($query) use ($info) {
                $query->select('cottage_id')
                    ->from(with(new Rental)->getTable())
                    ->whereBetween('from', [$info['dateFrom'], $info['dateTo']])
                    ->whereBetween('to', [$info['dateFrom'], $info['dateTo']]);
            })->where('accommodation', '<', 5)->first()->toArray();

        }

        if (isset($cottages) && !empty($cottages)) { // verificamos que la variable se seteo y no está vacia, ya que si lo estuviera no tiene sentido enviar
            // la cabaña que es para menos de 5 personas ya que los demás no tendrían reserva.

            if (count($cottages) < $necesarias) {

                return response()->json(['error' => 'Lamentablemente no tenemos disponible la cantidad de cabañas necesarias para esa cantidad de personas en las fechas seleccionadas. Te pedimos disculpas. Por favor intenta nuevamente gracias.'], 404);

            }

            if (!empty($otherCottage)) { // verificamos si se necesita una para menos de 5 personas

                array_push($cottages, $otherCottage); // añadimos la cabaña al array

            }

            return response()->json(compact('cottages'), 200); // enviamos las cabañas

        } else if ($info['capacity'] < 5) { // si no está seteada $cottages preguntamos si es para menos de 5 personas

            return response()->json(['cottages' => $otherCottage], 200); // enviamos la cabaña

        }

        // si lo anterior falla enviamos el error con el status 404
        return response()->json(['error' => 'No hay cabañas disponibles para la fecha seleccionada. Por favor elija una nueva fecha.'], 404);
    }

    public function forCottages(Request $request)
    {

    }
}
