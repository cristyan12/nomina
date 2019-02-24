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
        ];
    }

    public function messages()
    {
        return [
            'code.same' => 'El código y el documento de identidad deben coincidir.',
            'document.unique' => 'El documento de identidad ya está en uso.'
        ];
    }
}
