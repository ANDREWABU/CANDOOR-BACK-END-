<?php

namespace App\Http\Requests\Api\Advisor;

use Illuminate\Foundation\Http\FormRequest;

class MotivationRequest extends FormRequest
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
            'is_prescrean_program'=>'required|boolean',
            'why_joined'=>'required|string'
        ];
    }
}
