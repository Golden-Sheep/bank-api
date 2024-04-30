<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TransferRequest
 *
 * @author Joao Victor S <dev.jvictor@gmail.com>
 */
class TransferRequest extends FormRequest
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
            'payer' => 'required|integer|exists:users,id|different:payee',
            'payee' => 'required|integer|exists:users,id',
            'value' => 'required|numeric|min:0.01',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'value.required' => 'The transfer amount is required.',
            'value.numeric' => 'The transfer amount must be a numeric value.',
            'value.min' => 'The minimum transfer amount is $0.01.',
            'payer.required' => 'The payer ID is required.',
            'payer.integer' => 'The payer ID must be an integer.',
            'payer.exists' => 'The specified payer does not exist in our database.',
            'payer.different' => 'The payer and payee must be different.',
            'payee.required' => 'The payee ID is required.',
            'payee.integer' => 'The payee ID must be an integer.',
            'payee.exists' => 'The specified payee does not exist in our database.',
        ];
    }
}
