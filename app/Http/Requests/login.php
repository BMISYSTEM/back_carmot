<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class login extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        //validara los campos seran correctos
        return [
            'email' => ['required','email','exists:users,email'],
            'password' =>['required']

        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'el correo es requerido',
            'email.email'=>'digite un correo valido',
            'email.exists' => 'el correo no existe',
            'password.required'=>'el password es obligatorio'
        ];
    }
}
