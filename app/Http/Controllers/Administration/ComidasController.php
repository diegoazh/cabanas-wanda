<?php

namespace App\Http\Controllers\Administration;

use App\Comidas;
use Illuminate\Http\Request;
use App\Http\Requests\RequestComida;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestComida $request)
    {
        $info = $request->all();

        $menu = new Comidas();
        $menu->name = $info['name'];
        $menu->type = $info['type'];
        $menu->description = $info['description'];
        $menu->price = $info['price'];

        try {

            $menu->save();

        }catch (\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error intentando guardar el plato: ERROR - ' . $exception->getCode() . ': ' . $exception->getMessage()], 500);

        }

        return response()->json(compact($menu), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comidas  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(RequestComida $request, Comidas $name)
    {
        $info = $request->all();

        $menu = Comidas::where('name', $name)->first();
        if(isset($info['name']) && !empty($info['name'])) { $menu->name = $info['name']; }
        if(isset($info['type']) && !empty($info['name'])) { $menu->type = $info['type']; }
        if(isset($info['description']) && !empty($info['name'])) { $menu->description = $info['description']; }
        if(isset($info['price']) && !empty($info['name'])) { $menu->price = $info['price']; }

        try {

            $menu->save();

        }catch (\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error intentando guardar el plato: ERROR - ' . $exception->getCode() . ': ' . $exception->getMessage()], 500);

        }

        return response()->json(compact($menu), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comidas  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comidas $name)
    {
        if (!$menu = $menu = Comidas::where('name', $name)->first()) {

            return response()->json(['error' => 'No hemos podido encontrar un plato con ese nombre.'], 404);

        } else {
            try {

                $menu->delete();

            }catch(\Exception $exception) {

                return response()->json(['error' => 'Ha ocurrido un error intentando eliminar el plato'], 500);

            }
        }

        return response()->json(['message' => 'El plato fué eliminado correctamente.'], 200);
    }
}
