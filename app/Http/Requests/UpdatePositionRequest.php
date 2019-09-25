<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePositionRequest extends FormRequest
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
            'code' => [
                'required', Rule::unique('positions')->ignore($this->position)
            ],
            'name' => 'required',
            'basic_salary' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'El campo código de SISDEM es requerido.',
            'code.unique' => 'El campo código de SISDEM debe ser único.',
            'name.required' => 'El campo Nombre del Cargo es requerido.',
            'basic_salary.required' => 'El campo Salario Básico es requerido.',
        ];
    }
}
