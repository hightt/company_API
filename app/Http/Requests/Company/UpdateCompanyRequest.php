<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:32'],
            'nip' => ['required', 'string', 'min:10', 'max:10'],
            'address' => ['required', 'string', 'min:3', 'max:128'],
            'city' => ['required', 'string', 'min:3', 'max:64'],
            'zipcode' => ['required', 'string', 'min:3', 'max:16'],
        ];
    }
}
