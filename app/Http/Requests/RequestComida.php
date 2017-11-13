<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestComida extends FormRequest
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
            'name' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'available' => 'boolean'
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
            'name.required' => 'Es necesario que le de un nombre al plato',
            'name.string' => 'El nombre debe ser texto',
            'type.required' => 'Es necesario que clasifique el plato en alguno de los tipos dados',
            'type.string' => 'El nombre debe ser texto',
            'description.required' => 'Es necesario que describa el plato',
            'description.string' => 'La descripción debe ser texto',
            'price.required' => 'Es necesario que asigne un valor en $ al plato',
            'price.numeric' => 'El precio debe puede tener hasta 2 decimales',
            'available.boolean' => 'La disponibilidad debe ser verdadero o falso'
        ];
    }
}
