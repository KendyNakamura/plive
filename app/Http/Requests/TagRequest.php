<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'title' => 'max:32|unique:tags|required',
            'text' => 'nullable|max:100',
        ];
    }

    public function messages()
    {
        return[
            '*.max' => __('e.max'),
            'title.unique' => __('e.unique'),
            'title.required' => __('e.required'),
        ];
    }
}
