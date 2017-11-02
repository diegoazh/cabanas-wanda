<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRentalStore extends FormRequest
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
            'lastname' => 'required|string',
            'email' => 'required|email',
            'dni' => 'nullable|integer',
            'passport' => 'nullable|string',
            'dateFrom' => 'required|string',
            'dateTo' => 'required|string'
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
            'name.required' => 'Es necesario que proporcione su nombre.',
            'name.string' => 'Su nombre debe ser unicamente texto.',
            'lastname.required' => 'Es necesario que proporcione su apellido.',
            'lastname.string' => 'Su apellido debe ser unicamente texto.',
            'email.required' => 'Necesitamos que nos brinde su email.',
            'email.email' => 'El email proporcionado debe tener un formato válido.',
            'dni.integer' => 'El DNI debe ser un númmero entero.',
            'passport.string' => 'El pasaporte debe ser una cadena de texto.',
            'dateFrom.required' => 'Necesitamos saber desde que fecha desea alquilar.',
            'dateFrom.string' => 'La fecha debe ser en formato de texto.',
            'dateTo.required' => 'Necesitamos saber hasta que fecha desea alquilar.',
            'dateTo.string' => 'La fecha debe ser en formato de texto.',
        ];
    }
}
