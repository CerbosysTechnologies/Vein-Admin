<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestFormRequest extends FormRequest
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
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => 'Name in English is required.',
            'name_hi.required' => 'Name in Hindi is required.',
            'name_mr.required' => 'Name in Marathi is required.',
            'price.required' => 'Price is required.',
            'images.required' => 'Image is required.',
            'images.image' => 'The file must be an image.',
            'images.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'images.max' => 'The image may not be greater than 2048 kilobytes.',
        ];
    }   
}
