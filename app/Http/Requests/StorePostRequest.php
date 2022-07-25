<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'draft'       => ['nullable'],
            'title'       => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'content'     => ['required', 'min:3'],
            'cover'       => ['required','file', 'mimes:jpg,jpeg,png', 'max:2048']
        ];
    }
}
