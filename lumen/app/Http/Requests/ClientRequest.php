<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

class ClientRequest extends RequestAbstract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|string|email',
            'username'      => 'required|string',
            'password'      => 'required|string',
            'address'       => 'required|string',
            'post_code'     => 'required|string',
            'contact_number' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute is required',
            'string' => ':attribute must be a string',
        ];
    }
}
