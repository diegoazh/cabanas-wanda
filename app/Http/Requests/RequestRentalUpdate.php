<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRentalUpdate extends FormRequest
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
            'description' => 'string|nullable',
            'state' => 'string',
            'side' => 'boolean'
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
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'state.string' => 'El estado debe ser una cadena de texto',
            'side.boolean' => 'Side debe ser verdadero o falso'
        ];
    }
}
