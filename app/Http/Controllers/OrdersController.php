<?php

namespace App\Http\Controllers;

use App\OrdersDetail;
use App\Rental;
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

                $rental = Rental::find($info['rental_id']);
                $dateFrom = Carbon::createFromFormat('Y-m-d', $rental->dateFrom);
                $dateTo = Carbon::createFromFormat('Y-m-d', $rental->dateTo);

                $order = new Order(['rental_id' => $info['rental_id']]);
                $order->save();

                foreach ($info['orders'] as $items) {

                    $delivery = Carbon::createFromFormat('d/m/Y', $items['delivery']);

                    if (!$delivery->between($dateFrom, $dateTo)) {

                        throw new \Exception('La fecha ' . $delivery->format('d/m/Y') . ' no se encuentra dentro del periodo de estadía según la reserva seleccionada. Las fechas deben encontrarse entre ' . $dateFrom->format('d/m/Y') . ' y ' . $dateTo->format('d/m/Y') . ' o ser iguales a las mismas, por favor verifique las fechas y reintente. Muchas gracias', 500);

                    }

                    $detail = new OrdersDetail([
                        'food_id' => $items['id'],
                        'delivery' => $delivery,
                        'quantity' => $items['quantity']
                    ]);

                    $order->ordersDetail()->save($detail);
                }
            });

        } catch(\Exception $exception) {

            return response()->json(['error' => 'Ocurrio un error intentando dar de alta el pedido.\n Por favor tenga en cuenta el siguiente detalle: Codigo: ' . $exception->getCode() . ' - Mensaje: ' . $exception->getMessage() . ' - Line: ' . $exception->getLine() . ' - File: ' . $exception->getFile()], 500);

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
    public function updateStates(Request $request, $id)
    {
        $hasChanges = false;
        $info = $request->only(['order_senia', 'order_state', 'orders_detail']);

        if (!$order = Order::find($id)) {

            return response()->json(['error' => 'No hemos encontrado el pedido solicitado. Por favor verifique y reintente.'], 404);

        }

        try {

            DB::transaction(function () use($info, $order, &$hasChanges) {

                if ($order->state !== $info['order_state']) {

                    $order->state = $info['order_state'];
                    $order->save();
                    $hasChanges = true;

                } else if ($order->senia !== $info['order_senia']) {

                    $order->senia = $info['order_senia'];
                    $order->senia_date = Carbon::now()->toDateTimeString();
                    $order->save();
                    $hasChanges = true;

                }

                foreach ($order->ordersDetail as $detail) {

                    foreach ($info['orders_detail'] as $newDetail) {

                        if ($detail->id === $newDetail['id'] && $detail->state !== $newDetail['state']) {

                            $detail->state = $newDetail['state'];
                            $detail->save();
                            $hasChanges = true;

                        }

                    }

                }

            });

        } catch (\Exception $exception) {

            return response()->json(['error' => 'Ha ocurrido un error realizando las actualizaciones. No se harán cambios. Por favor verifique el error y reintente. Error: ' . $exception->getMessage() . ' - Código: ' . $exception->getCode()], 500);

        }

        if (!$hasChanges) {

            return response()->json(['message' => 'No se realizaron cambios en la orden, por lo que hubo modificaciones.'], 200);

        }

        return response()->json(['message' => 'Las modificaciones se realizaron correctamente.'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('frontend.order-edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'rental_id' => 'required|integer',
            'order_id' => 'required|integer',
        ], [
            'rental_id.required' => 'Es necesario que proporcione la identificación del alquiler',
            'rental_id.integer' => 'el identificador debe ser un entero.',
            'order_id.required' => 'Es necesario que proporcione la identificación del alquiler',
            'order_id.integer' => 'el identificador debe ser un entero.',
        ]);

        $info = $request->all();

        if(!$pedido = Order::find($info['order_id'])) {

            return response()->json(['error', 'No hemos encontrado el pedido solicitado.'], 404);

        }

        $collection = collect($info['orders']);

        try {
            DB::transaction(function () use($info, $pedido, $collection) {

                $rental = Rental::find($info['rental_id']);
                $dateFrom = Carbon::createFromFormat('Y-m-d', $rental->dateFrom);
                $dateTo = Carbon::createFromFormat('Y-m-d', $rental->dateTo);

                foreach ($pedido->ordersDetail as $key => $detail) {

                    if (!$collection->contains('id', $detail->food_id)) {

                        $detail->delete();
                        $pedido->ordersDetail->pull($key);

                    }

                }

                unset($detail);

                foreach ($collection as $key => $detail) {

                    $delivery = Carbon::createFromFormat('d/m/Y', $detail['delivery']);

                    if (!$delivery->between($dateFrom, $dateTo)) {

                        throw new \Exception('La fecha ' . $delivery->format('d/m/Y') . ' no se encuentra dentro del periodo de estadía según la reserva seleccionada. Las fechas deben encontrarse entre ' . $dateFrom->format('d/m/Y') . ' y ' . $dateTo->format('d/m/Y') . ' o ser iguales a las mismas, por favor verifique las fechas y reintente. Muchas gracias', 500);

                    }

                    if (!$pedido->ordersDetail->contains('food_id', $detail['id'])) {

                        $detailNew = new OrdersDetail([
                            'food_id' => $detail['id'],
                            'delivery' => $delivery->toDateString(),
                            'quantity' => $detail['quantity']
                        ]);

                        $pedido->ordersDetail()->save($detailNew);

                    } else {

                        $first = $pedido->ordersDetail->firstWhere('food_id', $detail['id']);
                        $first->food_id = $detail['id'];
                        $first->delivery = $delivery->toDateString();
                        $first->quantity = $detail['quantity'];
                        $first->save();
                    }

                }
            });

        } catch(\Exception $exception) {

            return response()->json(['error' => 'Ocurrio un error intentando dar de alta el pedido.\n Por favor tenga en cuenta el siguiente detalle: Codigo: ' . $exception->getCode() . ' - Mensaje: ' . $exception->getMessage() . ' - Line: ' . $exception->getLine() . ' - File: ' . $exception->getFile()], 500);

        }

        return response()->json(['message' => 'El pedido fue actualizado correctamente'], 200);
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

    public function ordersForState($state, $results)
    {
        $quantity = $results > 100 ? 100 : $results;

        if (!$orders = Order::where('state', $state)->orderBy('created_at', 'desc')->paginate($quantity)) {

            return response()->json(['error' => 'No hemos encontrado resultados con el estado seleccionado.'], 404);

        }

        foreach ($orders as $order) {

            $order->edit = false;
            $order->rental->cottage;

            foreach ($order->ordersDetail as $detail) {
                $detail->food;
            }

        }

        return response()->json($orders, 200);
    }

    public function findForId($id)
    {
        if (!$order = Order::find($id)) {

            return response()->json(['error' => 'No encontramos la orden solicitada. Por favor verifique y reintente. Gracias'], 404);

        }

        try {

            $order->rental->cottage;
            $order->user;
            foreach ($order->ordersDetail as $detail) {
                $detail->food;
            }

        } catch(\Exception $exception) {

            return response()->json(['error' => 'Se produjo un error al buscar la información relacionada a la orden solicitada. Verifique y reintente: Mensaje: ' . $exception->getMessage() . ' - Código: ' . $exception->getCode()], 500);

        }

        return response()->json($order, 200);
    }
}
