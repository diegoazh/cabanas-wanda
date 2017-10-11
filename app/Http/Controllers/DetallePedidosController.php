<?php

namespace App\Http\Controllers;

use App\DetallePedido;
use App\Http\Requests\RequestDetallePedidos;
use Illuminate\Http\Request;

class DetallePedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestDetallePedidos $request)
    {
        $detalle = new DetallePedido($request->all());

        try {

            $detalle->save();

        } catch (\Exception $exception) {

            return response()->json(['error' => 'Se produjo un error intentando añadir los items al pedido. Por favor verifique: ERROR: ' . $exception->getCode() . ' - Mensaje: ' . $exception->getMessage()], 500);

        }

        return response()->json(compact('detalle'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestDetallePedidos $request, $id)
    {
        $info = $request->all();

        if (!$detalle = DetallePedido::find($id)) {

            return response()->json(['error' => 'No hemos econtrado el item que intenta actualizar. Por favor verifique y reintente.'], 404);

        }

        $detalle->pedido_id = $info['pedido_id'];
        $detalle->comida_id = $info['comida_id'];
        $detalle->fecha_entrega = $info['fecha_entrega'];
        $detalle->cantidad = $info['cantidad'];

        try {

            $detalle->save();

        } catch (\Exception $exception) {

            return response()->json(['error' => 'Se produjo un error al intentar actualizar el item. Por favor verifique: ERROR: ' . $exception->getCode() . ' - Mensaje: ' . $exception->getMessage()], 500);

        }

        $message = 'El item del pedido se actualizó correctamente';

        return response()->json(compact('message', 'detalle'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$detalle = DetallePedido::find($id)) {

            return response()->json(['error' => 'No hemos econtrado el item que intenta actualizar. Por favor verifique y reintente.'], 404);

        }

        try {

            $detalle->delete();

        } catch (\Exception $exception) {

            return response()->json(['error' => 'Se produjo un error al intentar eliminar el item. Por favor verifique: ERROR: ' . $exception->getCode() . ' - Mensaje: ' . $exception->getMessage()], 500);

        }

        return response()->json(['message' => 'Se eliminó el item de manera correcta.'], 200);
    }
}
