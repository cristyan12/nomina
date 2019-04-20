<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
            'sex' => 'required',
            'city_of_born' => 'required',
            'hired_at' => 'required|date|after:born_at|different:born_at',
            'profession_id' => 'required|integer',
            'contract' => 'required',
            'bank_pay_id' => 'required|integer',
            'account_number' => 'required',
            'branch_id' => 'required|integer',
            'department_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'position_id' => 'required|integer',
        ];
    }
}
