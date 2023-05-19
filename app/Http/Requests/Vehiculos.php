<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Vehiculos extends FormRequest
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
            'marcas' => ['required'],
            'modelos' => ['required'],
            'estados' => ['required'],
            'placa' => ['required'],
            'kilometraje' => ['required'],
            'valor' => ['required'],
            'descripcion' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'marca.required' => ['la marca es requerida'],
            'modelo.required' => ['el modelo es requerido'],
            'estado.required' => ['el estado es requerido'],
            'placa.required' => ['la placa es requerida'],
            'kilometraje.required' => ['el kilometraje es requerido'],
            'valor.required' => ['el valor es requerido'],
            'descripcion.required' => ['la descripcion es requerida'],
        ];
    }
}
