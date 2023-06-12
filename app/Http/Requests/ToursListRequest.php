<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ToursListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // TODO: change to false when auth is implemented
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'priceFrom' => 'nullable|numeric|min:0',
            'priceTo' => 'nullable|numeric|min:0',
            'dateFrom' => 'nullable|date',
            'dateTo' => 'nullable|date',
            'sortBy' => Rule::in(['price']),
            'sortOrder' => Rule::in(['asc', 'desc']),
        ];
    }



    public function messages(){
        return[
            'sortBy' => "The 'sortBy' parameter accepts only 'price' value",
            'sortOrder' => "The 'sortOrder' parameter accepts only 'asc' and 'desc' values",
        ];
    }
}
