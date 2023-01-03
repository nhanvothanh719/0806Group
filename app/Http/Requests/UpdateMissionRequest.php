<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMissionRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'end_at' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name mission is required',
            'description.required' => 'The mission description is required',
            'end_at.required' => 'The deadline is required',
            'name.max' => 'The name semester is too long, please try again',
            'description.max' => 'The mission description is too long, please try again',
        ];        
    }
}
