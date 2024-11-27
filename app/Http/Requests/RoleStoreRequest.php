<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required | unique:roles,name,' . $this->name,
            'guard' => 'required|in:web'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $message = implode(' ', $validator->errors()->all());
        throw new HttpResponseException(
            redirect()->back()
                ->with('error', $message) // Pass the single message to the session
                ->withInput($this->all()) // Retain input data in the session
        );
    }
}
