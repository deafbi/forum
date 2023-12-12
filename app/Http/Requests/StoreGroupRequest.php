<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:groups'],
            'slug' => ['required', 'string', 'max:255', 'unique:groups'],
            'description' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'group_avatar' => ['required', 'string', 'max:255'],
            'owner_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'slug.required' => 'A slug is required',
            'description.required' => 'A description is required',
            'color.required' => 'A color is required',
            'group_avatar.required' => 'A group avatar is required',
            'owner_id.required' => 'An owner id is required',
        ];
    }
}
