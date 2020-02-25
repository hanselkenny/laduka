<?php

namespace App\Model\Requests\Auth;

use App\Model\Requests\PostRequest;

class UserRegisterPostRequest extends PostRequest
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
            'NamaLengkap' => 'required|string|max:50|unique:anggotas',
            'Username' => 'required|string|max:50|unique:users',
            'NIK' => 'required|int|digits:16|unique:anggotas',
            'NoTelp' => 'required|string|max:13',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|int'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'E-Mail must not be empty',
            'email.email' => 'Invalid e-mail format',
            'email.unique' => 'E-Mail has already existed',

            'Username.required' => 'Username must not be empty',
            'Username.alpha_num' => 'Username must only contain alphanumeric characters',
            'Username.between' => 'Username must be between 8 and 50 characters long',
            'Username.unique' => 'Username is already taken',

            'NamaLengkap.required' => 'Nama Lengkap must not be empty',
            'NamaLengkap.unique' => 'Nama Lengkap has already existed',

            'NIK.required' => 'NIK must not be empty',
            'NIK.unique' => 'NIK is already taken',

            'password.required' => 'Password must not be empty',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Please correctly confirm the password'
        ];
    }
}
