<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MissionRequest extends FormRequest
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
            'name' => 'required|string|unique:missions|max:255',
            'description' => 'required|string|max:255',
            'semester' => 'required',
            'end_at' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name mission is required',
            'name.unique' => 'The name mission is already exists',
            'description.required' => 'The mission description is required',
            'end_at.required' => 'The deadline is required',
            // 'department.required' => 'Please choose the department',
            // 'semester.required' => 'Please choose the semester',
        ];        
    }


}
