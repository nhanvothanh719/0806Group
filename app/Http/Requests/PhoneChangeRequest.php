<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneChangeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'new-phone-number' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|size:10',
        ];
    }

    public function messages()
    {
        return [
            'new-phone-number.required' => 'The new phone number is required',
            'new-phone-number.size' => 'The phone number must contain 10 characters',
            'regex' => 'The format of the new phone number is not valid'
        ];        
    }
}
