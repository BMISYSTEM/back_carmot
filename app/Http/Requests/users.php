<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;


class users extends FormRequest
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
        return [
            'nombre' => ['required','min:2'],
            'apellido' => ['required','min:2'],
            'date' => ['required'],
            'cedula'=>['required','unique:users,cedula'],
            'email' => ['required','email','unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(8)->letters()->symbols()->numbers(),
            ],
            'dashboard'=>['required'],
            'administrador'=>['required'],
            'usuarios'=>['required'],
            'recepcion'=>['required'],
            'ajustes'=>['required'],
            'campanas'=>['required'],
            'contabilidad'=>['required'],
            'transferencias'=>['required'],
            'proveedor'=>['required'],
            
            
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'el nombre es requerido',
            'nombre.min' => 'el nombre es muy corto',
            'apellido.required'=>'el apellido es requerido',
            'apellido.min'=>'el apellido es muy corto',
            'date.required'=>'la fecha es requerida',
            'email.email'=>'digite un correo valido',
            'email.required'=>'el correo es requerido',
            'email.unique'=>'ya esta registrado este correo',
            'password.required'=>'el password es obligatorio',
            'password.confirmed'=>'el password de copnfitmacion no coincide',
            'password'=>'el password debe tenener minimo 8 caracteres una letra,un numero y un simbolo',
            'cedula.required' =>'la cedula es requerida',
            'cedula.uniqued' =>'la cedula ya se encuentra registrada'
        ];
    }
}
