<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        return ['name' => ['min:3', 'max:70', 'string'],
            'username' => ['alpha_dash', 'min:3', 'max:30', Rule::unique('users', 'username')->ignore($this->user())],
            'phone' => [new PhoneNumberRule, Rule::unique('users', 'phone')->ignore($this->user())]
        ];
    }

    public function prepareForValidation()
    {
        if ($this->has('phone')) {
            $this->merge(['phone' => '+1' . preg_replace('/\D/', '', $this->phone)]);
        }
    }

}
