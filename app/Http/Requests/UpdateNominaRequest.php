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
            'name' => ['required', Rule::unique('nominas')->ignore($this->nomina)],
            'type' => 'required',
            'periods' => '',
            'first_period_at' => 'nullable|date',
            'last_period_at' => 'nullable|date|different:first_period_at|after:first_period_at',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre de la nómina es obligatorio',
            'name.unique' => 'El Nombre ya está en uso, por favor use otro',
            'type.required' => 'El Tipo de la nómina es obligatorio',
            'first_period_at.date' => 'La fecha del primer período debe ser una fecha válida',
            'last_period_at.date' => 'La fecha del último período debe ser una fecha válida',
            'last_period_at.different' => 'Las fechas de los campos Primer Período y Último Período deben ser diferentes',
            'last_period_at.after' => 'La fecha del último período debe ser una fecha posterior a la fecha del primer período',
        ];
    }
}
