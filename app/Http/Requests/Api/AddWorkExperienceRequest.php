<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddWorkExperienceRequest extends FormRequest
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
            'company' => 'required|string||max:255',
            'employment_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'industry' => 'required|max:255',
            'role' => 'required|max:255',
            'title' => 'required|string|max:255',
            // 'ask_me_about' => 'required|string|max:255',
        ];
    }
}
