<?php

namespace App\Http\Requests;

use App\Rules\CaptchaRule;
use App\Rules\PasswordRule;
use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
        $rules = ['name' => ['required', 'min:3', 'max:70', 'string'],
            'username' => ['required', 'alpha_dash', 'min:3', 'max:30', 'unique:users,username'],
            'email' => ['required', 'email:rfc', 'max:255', 'unique:users,email'],
            'phone' => ['required', new PhoneNumberRule, 'unique:users,phone'],
            'password' => ['required', 'min:8', 'max:75', 'confirmed', new PasswordRule],
            'terms' => 'required'
        ];

        if (config('services.recaptcha.enable')) {
            $rules['g-recaptcha-response'] = [ 'required', new CaptchaRule($this->ip())];
        }

        return $rules;
    }

    public function prepareForValidation()
    {
        if ($this->has('phone')) {
            $this->merge(['phone' => '+1' . preg_replace('/\D/', '', $this->phone)]);
        }
    }
}
