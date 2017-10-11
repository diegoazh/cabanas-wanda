<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // retornar la página de comidas en el frontend
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fecha_pedido' => 'required|string',
            'rental_id' => 'required|integer',
        ], [
            'fecha_pedido.required' => 'Es necesario que proporcione la fecha del pedido',
            'fecha_pedido.string' => 'Es necesario que la fecha sea una cadena de texto',
            'rental_id.required' => 'Es necesario que proporcione la identificación del alquiler',
            'rental_id.integer' => 'el identificador debe ser un entero.',
        ]);

        $pedido = new Pedido($request->all());

        try {

            $pedido->save();

        } catch(\Exception $exception) {

            return response()->json(['error' => 'Ocurrio un error intentando dar de alta el pedido. Por favor verifiquelo: Codigo: ' . $exception->getCode() . ' - Mensaje: ' . $exception->getMessage()], 500);

        }

        return response()->json(compact('pedido'), 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rental_id' => 'required|integer',
        ], [
            'rental_id.required' => 'Es necesario que proporcione la identificación del alquiler',
            'rental_id.integer' => 'el identificador debe ser un entero.',
        ]);

        $info = $request->all();
        $pedido = Pedido::find($id);

        if(!$pedido) {

            return response()->json(['error', 'No hemos encontrado el pedido solicitado.'], 404);

        }

        try {

            $pedido->rental_id = $info['rental_id'];
            $pedido->save();

        } catch(\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error actualizando el pedido. Por favor verifiquelo: Codigo: ' . $exception->getCode() . ' - Mensaje: ' . $exception->getMessage()], 500);

        }

        $message = 'El pedido fue actualizado correctamente';

        return response()->json(compact('message', 'pedido'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id);

        if(!$pedido) {

            return response()->json(['error', 'No hemos encontrado el pedido solicitado.'], 404);

        }

        try {

            $pedido->delete();

        } catch(\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error eliminando el pedido. Por favor verifiquelo: Codigo: ' . $exception->getCode() . ' - Mensaje: ' . $exception->getMessage()], 500);

        }

        return response()->json(['message' => 'El pedido fue eliminado correctamente.'], 200);
    }
}
