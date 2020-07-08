<?php

namespace App\Http\Requests;

use App\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'nationality' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'rif' => 'required',
            'born_at' => 'required|date',
            'civil_status' => 'required',
            'sex' => 'required',
            'city_of_born' => 'required',
            'hired_at' => 'required|date|after:born_at|different:born_at',
            'nomina_id' => 'required',
            'profession_id' => 'required',
            'contract' => 'required',
            'status' => 'required',
            'bank_id' => 'required',
            'account_number' => 'required|min:20|max:20',
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
            'nationality' => 'Nacionalidad',
            'city_of_born' => 'Ciudad de nacimiento',
            'hired_at' => 'Fecha de contratación',
            'profession_id' => 'Profesión',
            'contract' => 'Contrato',
            'status' => 'Status',
            'bank_id' => 'Banco',
            'account_number' => 'Número de cuenta',
            'branch_id' => 'Sucursal',
            'department_id' => 'Departamento',
            'unit_id' => 'Unidad',
            'position_id' => 'Cargo',
            'nomina_id' => 'Nómina',
        ];
    }

    public function messages()
    {
        return [
            'code.same' => 'El código y la cédula de identidad deben coincidir',
            'document.unique' => 'La Cédula de identidad ya está en uso',
        ];
    }

    public function save()
    {
        DB::transaction(function () {
            $data = $this->validated();

            $employee = new Employee([
                'code' => $data['code'],
                'document' => $data['document'],
                'nationality' => $data['nationality'],
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'rif' => $data['rif'],
                'born_at' => $data['born_at'],
                'civil_status' => $data['civil_status'],
                'sex' => $data['sex'],
                'city_of_born' => $data['city_of_born'],
                'hired_at' => $data['hired_at'],
                'nomina_id' => $data['nomina_id']
            ]);

            auth()->user()->employees()->save($employee);

            $employee->profile()->create([
                'profession_id' => $data['profession_id'],
                'contract' => $data['contract'],
                'status' => $data['status'],
                'bank_id' => $data['bank_id'],
                'account_number' => $data['account_number'],
                'branch_id' => $data['branch_id'],
                'department_id' => $data['department_id'],
                'unit_id' => $data['unit_id'],
                'position_id' => $data['position_id'],
            ]);
        });
    }
}
