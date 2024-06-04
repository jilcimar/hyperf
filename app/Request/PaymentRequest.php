<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class PaymentRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:1',
            'description' => 'required|max:255|min:3|string',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'The amount field is required',
            'amount.numeric' => 'The amount field must be numeric',
            'description.required' => 'The description field is required',
            'description.string' => 'The description field must be string',
            'description.min' => 'The description field must have at least 3 characters',
            'description.max' => 'The description field must have a maximum of 255 characters',
        ];
    }
}
