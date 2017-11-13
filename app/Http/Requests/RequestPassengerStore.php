<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPassengerStore extends FormRequest
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
            'dni' => 'integer',
            'passport' => 'string',
            'email' => 'required|email',
            'genre' => 'alpha',
            'country_id' => 'integer',
        ];
    }

    /**
     * Get the validation messages that apply to the rules above.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Es necesario que proporcione su nombre',
            'name.string' => 'Es necesario que el nombre se solo texto',
            'lastname.required' => 'Es necesario que proporcione su apellido',
            'lastname.string' => 'Es necesario que el apellido se solo texto',
            'dni.integer' => 'El dni debe ser un entero',
            'passport.string' => 'El pasaporte debe ser texto',
            'email.required' => 'Es necesario que proporcione su email',
            'email.email' => 'El email debe tener un formato de email válido',
            'genre.alpha' => 'El genero debe ser un caracter alfabético',
            'country_id.integer' => 'El país debe ser un entero'
        ];
    }
}
