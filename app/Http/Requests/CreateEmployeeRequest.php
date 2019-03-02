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
            'hired_at' => 'required|date|after:born_at|different:born_at',
            'profession_id' => 'required',
            'contract' => 'required',
            'status' => 'required',
            'bank_pay_id' => 'required',
            'account_number' => 'required',
            'branch_id' => 'required',
            'department_id' => 'required',
            'unit_id' => 'required',
            'position_id' => 'required',
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
            'profession_id' => 'Profesión',
            'contract' => 'Contrato',
            'bank_pay_id' => 'Banco',
            'account_number' => 'Número de cuenta',
            'branch_id' => 'Sucursal',
            'department_id' => 'Departamento',
            'unit_id' => 'Unidad',
            'position_id' => 'Cargo',
        ];
    }

    public function messages()
    {
        return [
            'code.same' => 'El código y la cédula de identidad deben coincidir',
            'document.unique' => 'La Cédula de identidad ya está en uso',
        ];
    }
}
