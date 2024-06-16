<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageFormRequest extends FormRequest
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
            'name_en' => 'required',
            'name_hi' => 'required',
            'name_mr' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'selected_tests' => 'required|array',
            'total_test_included' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name_en.required' => 'Name in English is required.',
            'name_hi.required' => 'Name in Hindi is required.',
            'name_mr.required' => 'Name in Marathi is required.',
            'price.required' => 'Price is required.',
            'image.required' => 'Image is required.', 
            'image.image' => 'The file must be an image.', 
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.', 
            'image.max' => 'The image may not be greater than 2048 kilobytes.', 
            'total_test_included.required' => 'The test number is required.',
        ];
    } 
}
