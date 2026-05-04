<?php

namespace App\Http\Requests\Api;

use App\Models\Api\WorkExperience;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class CheckWorkExperienceIDRequest extends FormRequest
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
            'id' => 'required|integer|exists:work_experiences,WorkExperienceID',
        ];
    }

    public function messages()
    {
        return [
            'id.exists'=>'The Given id is invalid.'
        ];
    }
}
