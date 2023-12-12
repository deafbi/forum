<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VouchStoreRequest extends FormRequest
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
            'type' => 'required|in:positive,neutral,negative',
            'reason' => 'required|string|max:255|min:10',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type.required' => 'You must select a vouch type.',
            'type.in' => 'You must select a valid vouch type.',
            'reason.required' => 'You must provide a reason for the vouch.',
            'reason.string' => 'The vouch reason must be a string.',
            'reason.max' => 'The vouch reason must be less than 255 characters.',
            'reason.min' => 'The vouch reason must be at least 10 characters.',
        ];
    }
}
