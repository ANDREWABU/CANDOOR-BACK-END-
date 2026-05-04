<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddUserCarrerGoalRequest extends FormRequest
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
            'next_carrer_goals'=>'required|string|max:999',
            'why_joined'=>'required|string|max:999',
            'dream_roles'=>'required|array',
            'dream_industries'=>'required|array',
            'dream_companies'=>'required|array',
            'employment_opportunities'=>'required|string',
            'is_prescrean_program'=>'required|boolean',
        ];
    }
}
