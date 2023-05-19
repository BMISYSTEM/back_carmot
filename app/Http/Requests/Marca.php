<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Marca extends FormRequest
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
            'nombre'=>['required','unique:marcas,nombre']
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'=> 'el nombre es obligatorio',
            'nombre.unique'=> 'esta marca ya se encuentra registrada'
        ];
    }
}
