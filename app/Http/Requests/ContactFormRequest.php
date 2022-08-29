<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactFormRequest extends FormRequest
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
        return ['email' => ['required', 'email:rfc', 'max:255'],
            'subject' => ['required', Rule::in(['other', 'account', 'fraud', 'feedback'])],
            'message' => ['required', 'min:10', 'max:10000']];
    }

    public function passedValidation()
    {
        $this->merge(['subject' => $this->convertSubjectString($this->input('subject'))]);
    }

    private function convertSubjectString(string $rawString) {
        return match ($rawString) {
            'account' => __('Account issues'),
            'fraud' => __('Fraud or spam'),
            'feedback' => __('Feedback'),
            default => __('Other'),
        };
    }
}
