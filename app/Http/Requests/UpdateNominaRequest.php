<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule; 
use Illuminate\Foundation\Http\FormRequest;

class UpdateNominaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('nominas')->ignore($this->nomina)
            ],
            'type' => 'required',
            'periods' => '',
            'first_period' => '', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre de la nómina es obligatorio',
            'type.required' => 'El Tipo de la nómina es obligatorio',
        ];
    }
}
