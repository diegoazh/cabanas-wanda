<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestLiquidation extends FormRequest
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
            'rental_id' => 'required|integer',
            'email' => 'required|email',
            'password' => 'required|string',
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
            'rental_id.required' => 'Es necesario que proporcione la reserva.',
            'rental_id.integer' => 'La reserva debe ser un entero.',
            'email.required' => 'Es necesario que proporcione su email.',
            'email.email' => 'El email debe tener un formato válido.',
            'password.required' => 'Es necesario que proporcione su contraseña.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
        ];
    }
}
