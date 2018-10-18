<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiveRequest extends FormRequest
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
            'title.*' => 'required|max:100',
            'date.*' => 'nullable|integer',
            'place_id.*' => 'nullable|integer|exists:places,id',
            'is_active.*' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return[
            'title.*.max' => __('e.max'),
            '*.required' => __('e.required'),
            '*' => __('e.error'),
        ];
    }
}
