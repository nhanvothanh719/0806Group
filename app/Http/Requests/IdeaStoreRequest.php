<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdeaStoreRequest extends FormRequest
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
            'title' => 'required|string|unique:ideas|max:255',
            'content' => 'required|string',
            'mission_id' => 'required|string',
            'is-agree' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'is-agree.required' => 'You must agree with all terms and conditions before submitting',
        ];        
    }
}
