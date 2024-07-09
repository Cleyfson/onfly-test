<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDespesaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'descricao' => 'required|string|max:191',
            'valor' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get the validation messages that apply to the rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'descricao.required' => 'The description is required.',
            'descricao.string' => 'The description must be a string.',
            'descricao.max' => 'The description may not be greater than 191 characters.',
            'valor.required' => 'The value is required.',
            'valor.numeric' => 'The value must be a number.',
            'valor.min' => 'The value cannot be negative.',
        ];
    }
}
