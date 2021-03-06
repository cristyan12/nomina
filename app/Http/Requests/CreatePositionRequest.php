<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePositionRequest extends FormRequest
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
            'code' => 'required|unique:positions,code',
            'name' => 'required|unique:positions,name',
            'basic_salary' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'El campo código de SISDEM es requerido.',
            'code.unique' => 'El campo código de SISDEM debe ser único.',
            'name.required' => 'El campo Cargo es requerido.',
            'name.unique' => 'El campo Cargo debe ser único.',
            'basic_salary.required' => 'El campo Salario Básico es requerido.',
            'basic_salary.numeric' => 'El campo Salario Básico debe ser un número.',
        ];
    }
}
