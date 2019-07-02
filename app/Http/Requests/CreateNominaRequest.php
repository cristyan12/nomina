<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNominaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:nominas',
            'type' => 'required',
            'periods' => '',
            'first_period' => '',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre de la nómina es obligatorio',
            'name.unique' => 'El Nombre ya está en uso, por favor use otro',
            'type.required' => 'El Tipo de la nómina es obligatorio',
        ];
    }
}
