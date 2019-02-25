<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'code' => 'required|same:document',
            'document' => 'required|unique:employees,document',
            'last_name' => 'required',
            'first_name' => 'required',
            'rif' => 'required',
            'born_at' => 'required|date',
            'sex' => 'required',
            'city_of_born' => 'required',
            'hired_at' => 'required|date|after:born_at|different:born_at'
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'Código',
            'document' => 'Cédula',
            'last_name' => 'Apellido',
            'first_name' => 'Nombre',
            'rif' => 'Registro de Información Fiscal (RIF)',
            'born_at' => 'Fecha de nacimiento',
            'sex' => 'Sexo',
            'city_of_born' => 'Ciudad de nacimiento',
            'hired_at' => 'Fecha de contratación',
        ];
    }

    public function messages()
    {
        return [
            'code.same' => 'El código y el documento de identidad deben coincidir',
            'document.unique' => 'El documento de identidad ya está en uso'
        ];
    }
}
