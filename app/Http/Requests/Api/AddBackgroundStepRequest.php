<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddBackgroundStepRequest extends FormRequest
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
            'country'=>'required|string|max:255',
            'city'=>'required|string|max:255',
            'state'=>'string|max:255',
            'state'=>[Rule::requiredIf($this->country=="United States" || $this->country=="United States Minor Outlying Islands" )],
            'time_zone'=>'required|string|max:255',
            'gender'=>'required|string|max:255',
            'race'=>'required|array',
            'extra_info'=>'nullable|string|max:1000',
            'belongs_to'=>'required|array',
        ];
    }
}
