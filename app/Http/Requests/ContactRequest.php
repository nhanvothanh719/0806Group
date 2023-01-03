<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|size:10',
            'user_message' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'phone_number.size' => 'The phone number must contain 10 characters',
            'regex' => 'The format of the phone number is not valid'
        ];        
    }
}