<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRentalFind extends FormRequest
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
            'reserva' => 'string',
            'dni' => 'numeric',
            'emal' => 'email',
            'fromNow' => 'boolean'
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
            'reserva.string' => 'El codigo de reserva debe ser una cadena de texto.',
            'dni.numeric' => 'El dni debe ser un número.',
            'email.email' => 'El email debe tener un formato de email válido.',
            'fromNow.boolean' => 'El parametro enviado en cuarto lugar debe ser verdadero o falso.'
        ];
    }
}
