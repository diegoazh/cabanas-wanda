<?php

namespace App\Http\Controllers\Administration;

use JWTAuth;
use App\Comida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\RequestComida;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ComidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = null;

        if (Auth::check()) {

            if (Auth::user()->isAdminOrEmployed()) {

                $token = JWTAuth::fromUser(Auth::user());

            }
        }

        Cookie::queue('info_one', $token, 180, null, null, false, false); // el último parametro es importante sino la cookie no es accesible desde el cliente $httpOnly = true es el default

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

        $menu = new Comida();
        $menu->name = $info['name'];
        $menu->type = $info['type'];
        $menu->description = $info['description'];
        $menu->price = $info['price'];

        try {

            $menu->save();

        }catch (\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error intentando guardar el plato: ERROR - ' . $exception->getCode() . ': ' . $exception->getMessage()], 500);

        }

        return response()->json(['message' => 'La información se dió de alta correctamente'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestComida $request, $id)
    {
        $info = $request->all();

        if (!$menu = Comida::find($id)) {

            return response()->json(['error' => 'No hemos podido encontrar un plato con ese nombre.'], 404);

        }

        if(isset($info['name']) && !empty($info['name'])) { $menu->name = $info['name']; }
        if(isset($info['type']) && !empty($info['name'])) { $menu->type = $info['type']; }
        if(isset($info['description']) && !empty($info['name'])) { $menu->description = $info['description']; }
        if(isset($info['price']) && !empty($info['name'])) { $menu->price = $info['price']; }

        try {

            $menu->save();

        }catch (\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error intentando guardar el plato: ERROR - ' . $exception->getCode() . ': ' . $exception->getMessage()], 500);

        }

        return response()->json(['message' => 'El plato se actualizó correctamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$menu = Comida::find($id)) {

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

    /**
     * Return all resources from DB.
     *
     *
     *
     */
    public function all()
    {
        $comidas = Comida::orderBy('type')->orderBy('name')->get();

        return response()->json(compact('comidas'), 200);
    }
}
