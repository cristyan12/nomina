<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateConceptRequest extends FormRequest
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
            'name' => ['required', 'unique:concepts'],
            'type' => [
                'required',
                Rule::in(['asignacion', 'deduccion'])
            ],
            'description' => ['required'],
            'quantity' => ['required'],
            'calculation_salary' => ['required'],
            'formula' => ['required'],
        ];
    }
}
