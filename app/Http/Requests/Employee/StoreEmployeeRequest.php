<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'company_id' => ['required', 'numeric', 'exists:companies,id'],
            'first_name' => ['required', 'string', 'min:2', 'max:32'],
            'last_name' => ['required', 'string', 'min:2', 'max:32'],
            'email' => ['required', 'email', 'min:3', 'max:32'],
            'phone_number' => ['nullable', 'string', 'min:3', 'max:32'],
        ];
    }
}
