<?php

namespace App\Http\Controllers;

use App\OrdersDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = null;

        if (Auth::check()) {

            $user = Auth::user();

        }

        Cookie::queue('info_one', isset($user) ? $user->dni : null, 60, null, null, false, false); // el último parametro es importante sino la cookie no es accesible desde el cliente $httpOnly = true es el default
        Cookie::queue('info_two', isset($user) ? $user->email : null, 60, null, null, false, false);

        return view('frontend.order-index');
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
            'rental_id' => 'required|integer',
        ], [
            'rental_id.required' => 'Es necesario que proporcione la identificación del alquiler',
            'rental_id.integer' => 'el identificador debe ser un entero.',
        ]);

        $info = $request->only('rental_id', 'orders');

        try {
            DB::transaction(function () use($info) {

                $order = new Order(['rental_id' => $info['rental_id']]);
                $order->save();

                foreach ($info['orders'] as $items) {
                    $detail = new OrdersDetail([
                        'food_id' => $items['id'],
                        'delivery' => Carbon::createFromFormat('Y-m-d', explode('T', $items['delivery'])[0]),
                        'quantity' => $items['quantity']
                    ]);

                    $order->ordersDetail()->save($detail);
                }
            });

        } catch(\Exception $exception) {

            return response()->json(['error' => 'Ocurrio un error intentando dar de alta el pedido. Por favor verifiquelo: Codigo: ' . $exception->getCode() . ' - Mensaje: ' . $exception->getMessage()], 500); //  . ' - Line: ' . $exception->getLine()

        }

        return response()->json(['message' => 'Se dió de alta correctamente el pedido.'], 200);

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
        $pedido = Order::find($id);

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
        $pedido = Order::find($id);

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
