<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoadFamiliarRequest extends FormRequest
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
            'employee_id' => 'required',
            'name' => 'required',
            'relationship' => 'required',
            'document' => 'required|unique:load_familiars',
            'sex' => 'required',
            'born_at' => 'required|date',
            'instruction' => 'required',
            'reference' => '',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'El Nombre del familiar es obligatorio',
            'relationship.required' => 'El Parentesco del familiar es obligatorio',
            'document.required' => 'El Número de cédula del familiar es obligatorio',
            'document.unique' => 'El Número de cédula ya está en uso.',
            'sex.required' => 'El Género del familiar es obligatorio',
            'born_at.required' => 'La Fecha de nacimiento del familiar es obligatoria',
            'born_at.date' => 'La Fecha de nacimiento del familiar debe ser una fecha válida',
            'instruction.required' => 'El Grado de Istrucción del familiar es obligatorio',
        ];
    }
}
