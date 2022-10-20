<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonnelStoreRequest extends FormRequest
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
            'national_code' => ['required', 'digits:10', Rule::unique('personnels')->ignore($this->personnel)],
            'mobile' => ['required', 'digits:11', Rule::unique('personnels')->ignore($this->personnel)],
            'is_full_time' => 'required|in:0,1',
        ];
    }
}
