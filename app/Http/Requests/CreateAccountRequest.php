<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
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
            'bank_id' => 'required|integer',
            'number' => 'required|unique:accounts|size:20',
            'auth_1' => 'required|integer',
            'auth_2' => 'nullable|present|integer',
        ];
    }

    public function attributes()
    {
        return [
            'bank_id' => 'Banco',
            'number' => 'Número de cuenta',
            'auth_1' => 'Primer autorizado',
            'auth_2' => 'Segundo autorizado',
        ];
    }
}
