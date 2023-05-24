<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Clientes extends FormRequest
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

            'nombre' => ['required'],
            'apellido'=>['required'],
            'cedula'=>['required'],
            'data'=>['required','date'],
            'telefono'=>['required','numeric'],
            'email'=>['required','email'],
            'vehiculos'=>['required'],
            'valorf'=>['required'],
            'tasa'=>['required'],
            'cuotas'=>['required']
            //
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'=>'debe ingresar un nombre',
            'apellido.required'=>'debe ingresar un apellido',
            'cedula.required'=>'debe ingresar una cedula',
            'data.required'=>'debe ingresar una fecha',
            'data.date'=>'debe ingresar una fecha valida',
            'telefono.required'=>'debe ingresar un telefono',
            'telefono.numeric'=>'debe ingresar un telefono valido',
            'email.required'=>'debe ingresar un correo',
            'email.email'=>'debe ingresar un correo valido',
            'vehiculos.required'=>'debe seleccionar un vehiculo'
        ];
    }
}
