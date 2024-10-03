<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'slug' => 'required|string|min:5|max:500|unique:posts', // Ensure slug is unique
            'description' => 'nullable|string',
            'content' => 'nullable',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
            'posted' => 'required|in:yes,not', // Only accept these values
        ];
    }
}