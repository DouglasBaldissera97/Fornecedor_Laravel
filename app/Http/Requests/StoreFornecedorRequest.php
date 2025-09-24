<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:fornecedores,cnpj',
            'email' => 'nullable|email|max:255',
            'criado_em' => 'date'
        ];
    }
}
