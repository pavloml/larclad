<?php

namespace App\Http\Requests;

use App\Services\HtmlSanitizerService;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
        return ['title' => ['required', 'min:3', 'max:70'],
            'description' => ['required', 'min:10', 'max:10000'],
            'subcategory_id' => ['required', 'numeric', 'exists:subcategories,id'],
            'city_id' => ['required', 'numeric', 'exists:cities,id'],
            'price' => ['numeric', 'between:0,1000000000', 'nullable'],
            'image' => ['file', 'mimes:jpg,png', 'max:8000']
        ];
    }

    public function prepareForValidation()
    {
        $sanitizer = new HtmlSanitizerService();

        $this->merge(['price' => $this->post('price') ?? 0,
            'description' => $sanitizer->sanitize($this->post('description'))]);
    }
}
