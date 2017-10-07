<?php

namespace App\Http\Controllers\Administration;

use App\Comidas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.comidas');
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
     * @param  \App\Comidas  $menus
     * @return \Illuminate\Http\Response
     */
    public function show(Comidas $menus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comidas  $menus
     * @return \Illuminate\Http\Response
     */
    public function edit(Comidas $menus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comidas  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comidas $menus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comidas  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comidas $menus)
    {
        //
    }
}
