<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoresRequests extends FormRequest
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
            'name'                   => ['required'],
            'address'                => ['required'],
            'city'                   => ['required'],
            'state'                  => ['required'],
            'country'                => ['required'],
            'zip'                    => ['required','string',],
            'phone'                  => ['required','string','regex:/^(\+?1\s?)?(\(\d{3}\)|\d{3})[-.\s]?\d{3}[-.\s]?\d{4}$/'],
            'currency'               => ['required'],
            'multi_location_enabled' => ['required'],
            
        ];
    }
}
