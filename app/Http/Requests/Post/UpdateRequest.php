<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:50',
            'slug' => 'required|string|min:5|max:500|unique:posts,slug,'.$this->route('id'), // Ensure slug is unique expection with itself
            'description' => 'nullable|string',
            'content' => 'nullable',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
            'posted' => 'in:yes,not', // Only accept these values
            'image' => 'mimes:jpeg,png,jpg|max:1024'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422));
    }
}
