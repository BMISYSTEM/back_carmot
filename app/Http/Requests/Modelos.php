<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Modelos extends FormRequest
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
            'year' => ['required','unique:modelos,year']
        ];
    }
    public function messages()
    {
        return[
            'year.required'=>'digite un modelo',
            'year.unique'=>'este modelo ya esta registrado',
        ];
    }
}
