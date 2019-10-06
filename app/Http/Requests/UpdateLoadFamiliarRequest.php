<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateLoadFamiliarRequest extends CreateLoadFamiliarRequest
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
            'name' => 'required',
            'relationship' => 'required',
            'document' => ['required', Rule::unique('load_familiars')->ignore($this->document)],
            'sex' => 'required',
            'born_at' => 'required|date',
            'instruction' => 'required',
            'reference' => '',
        ];
    }
}
