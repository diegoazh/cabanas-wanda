<?php

namespace App\Http\Controllers;

use App\Rental;
use App\Cottage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\RentalRequest;

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

    public function forCapacity(RentalRequest $request)
    {
        $info = $request->all();

        // cambiamos las fechas con Carbon ya que sino nos da error al consultar en la DB.
        $info['dateFrom'] = Carbon::createFromFormat('d/m/Y', $info['dateFrom'])->toDateString();
        $info['dateTo'] = Carbon::createFromFormat('d/m/Y', $info['dateTo'])->toDateString();

        $cottages = Rental::cottageForCapacity($info['query'], $info['simple'], $info['dateFrom'], $info['dateTo']);

        if (empty($cottages)) {
            return response()->json(['error' => 'No tenemos cabañas disponibles en esa fecha para la capacidad indicada. Lo sentimos mucho, por favor prueba con otra fecha o varía la capacidad.'], 404);
        }

        return response()->json(compact('cottages'), 200);
    }

    public function forCottages(RentalRequest $request)
    {
        $info = $request->all();

        // cambiamos las fechas con Carbon ya que sino nos da error al consultar en la DB.
        $info['dateFrom'] = Carbon::createFromFormat('d/m/Y', $info['dateFrom'])->toDateString();
        $info['dateTo'] = Carbon::createFromFormat('d/m/Y', $info['dateTo'])->toDateString();

        $cottage = Rental::cottageForNumber($info['query'], $info['simple'], $info['dateFrom'], $info['dateTo']);

        if (empty($cottage)) {
            return response()->json(['error' => 'Lo sentimos la cabaña no está disponible en esa fecha. Por favor intenta con otra cabaña o con una fecha diferente.'], 404);
        }

        return response()->json(compact('cottage'), 200);
    }

    public function isUserLogged(Request $request)
    {
        return response()->json(compact('user', 'isLogged'), 200);
    }
}
