<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class ContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
      

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255',Rule::unique('contacts','email')->ignore( $this->route('contact'))],
            'phone_no' => ['required', 'array', 'min:1'],
            'birthday' => ['nullable','date', 'max:255'],
            'avatar' => ['nullable', 'image'],
            'country' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
        ];
       
        
    }
}
