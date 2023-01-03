<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'old-password' => 'required',
            'new-password' => 'required|min:6|max:50|string|confirmed',
            'new-password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'old-password.required' => 'The old password is required',
            'new-password.required' => 'The new password is required',
            'new-password.min' => 'The length of the new password is not smaller that 6',
            'new-password.max' => 'The length of the new password is not bigger that 50',
            'new-password.string' => 'The format of the new password is not correct',
            'new-password_confirmation.required' => 'The new password confirmation is required',
            'new-password.confirmed' => 'The provided new password confirmation does not match'
        ];        
    }
}
