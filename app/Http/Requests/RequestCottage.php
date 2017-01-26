<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCottage extends FormRequest
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
            'number' => 'unique:cottages|required|numeric',
            'name' => 'unique:cottages|required|string|max:10',
            'type' => 'required|string',
            'accommodation' => 'required|numeric|min:1|max:6',
            'description' => 'string|max:255',
            'price' => 'required|numeric'
        ];
    }
}
