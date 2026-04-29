<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => __('validation.required', ['attribute' => __('contact.name')]),
            'email.required'   => __('validation.required', ['attribute' => __('contact.email')]),
            'email.email'      => __('validation.email', ['attribute' => __('contact.email')]),
            'subject.required' => __('validation.required', ['attribute' => __('contact.subject')]),
            'message.required' => __('validation.required', ['attribute' => __('contact.message')]),
        ];
    }
}
