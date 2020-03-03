<?php

namespace App\Model\Requests\Auth;

use App\Model\Requests\PostRequest;

class AdminRegisterPostRequest extends PostRequest
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
            'NamaLengkap' => 'required|string|max:50|unique:detail_admins',
            'Username' => 'required|string|max:50|unique:admins',
            'NomorKaryawan' => 'required|int|digits:16|unique:detail_admins',
            'NoTelp' => 'required|string|max:13',
            'email' => 'required|string|email|max:255|unique:admins',
            'role_id' => 'required|int',
            'password' => 'required|string|min:8|confirmed'
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

            'NomorKaryawan.required' => 'Nomor karyawan must not be empty',
            'NomorKaryawan.unique' => 'Nomor karyawan has already existed',

            'role_id.required' => 'Role must not be empty',

            'password.required' => 'Password must not be empty',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Please correctly confirm the password'
        ];
    }
}
