<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class StoreItemRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp,svg',
                'max:5120',
            ],
            'description' => [
                'max:1000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'image.dimesions' => 'The image must not be larger than 2000px'
        ];
    }
}
