<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRental extends FormRequest
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
            'dateFrom.required' => 'Por favor indique la fecha de inicio de la reserva.',
            'dateFrom.string' => 'Por favor exprese la fecha como una cadena de texto.',
            'dateTo.required' => 'Por favor indique la fecha de fin de la reserva.',
            'dateTo.string' => 'Por favor exprese la fecha como una cadena de texto.'
        ];
    }
}
