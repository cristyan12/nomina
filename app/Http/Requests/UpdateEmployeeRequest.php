<?php

namespace App\Http\Requests;

use App\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends CreateEmployeeRequest
{
    public function rules()
    {
        return [
            'code' => 'required|same:document',
            'document' => [
            	'required',
            	Rule::unique('employees')->ignore($this->employee)
            ],
            'last_name' => 'required',
            'first_name' => 'required',
            'rif' => 'required',
            'born_at' => 'required|date|before:hired_at|different:hired_at',
            'civil_status' => 'required',
            'sex' => 'required',
            'nationality' => Rule::in('V', 'E'),
            'city_of_born' => 'required',
            'hired_at' => 'required|date|after:born_at|different:born_at',
            'nomina_id' => 'required',
            'profession_id' => 'required|integer',
            'status' => 'required',
            'contract' => 'required',
            'bank_id' => 'required|integer',
            'account_number' => 'required|min:20|max:20',
            'branch_id' => 'required|integer',
            'department_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'position_id' => 'required|integer',
        ];
    }

    public function update(Employee $employee)
    {
        DB::transaction(function () use ($employee) {
            $data = $this->validated();

            $employee->fill([
                'code' => $data['code'],
                'document' => $data['document'],
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'rif' => $data['rif'],
                'born_at' => $data['born_at'],
                'civil_status' => $data['civil_status'],
                'sex' => $data['sex'],
                'nationality' => $data['nationality'],
                'city_of_born' => $data['city_of_born'],
                'hired_at' => $data['hired_at'],
                'nomina_id' => $data['nomina_id'],
            ]);

            auth()->user()->employees()->save($employee);

            $employee->profile()->update([
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
