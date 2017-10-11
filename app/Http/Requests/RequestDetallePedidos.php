<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestDetallePedidos extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pedido_id' => 'required|integer',
            'comida_id' => 'required|integer',
            'fecha_entrega' => 'required|string',
            'cantidad' => 'required|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pedido_id.required' => 'Es necesario que indique cual es el pedido que al que desea asignar los items',
            'pedido_id.integer' => 'El pedido debe ser un número entero',
            'comida_id.required' => 'Es necesario que indique cual es el plato a asignar',
            'comida_id.integer' => 'El plato debe ser un número entero',
            'fecha_entrega.required' => 'Es necesario que indique la fecha para la cual desea el plato',
            'fecha_entrega.integer' => 'La fecha debe ser una cadena de texto',
            'cantidad.required' => 'Es necesario que indique la cantidad que desea por plato seleccionado',
            'cantidad.integer' => 'La cantidad debe estar expresada en números enteros',
        ];
    }
}
