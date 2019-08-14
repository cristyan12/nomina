<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
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
            'name' => ['required', Rule::unique('departments')->ignore($this->department)]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Departamento es requerido.',
            'name.unique' => 'El campo Departamento ya está siendo utilizado.',
        ];
    }
}
