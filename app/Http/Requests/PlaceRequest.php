<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
            'name' => 'unique:places|max:50|required',
            'url' => 'url|max:200|nullable',
            'prefecture' => 'required|in:' . implode(',', config('prefecture')),
            'capacity' => 'required|integer|between:10,30000'
        ];
    }

    public function messages()
    {
        return[
            '*.max' => __('e.max'),
            '*.required' => __('e.required'),
            'name.unique' => __('e.unique'),
            'url.url' => __('e.url'),
            'capacity.between' => __('e.between'),
        ];
    }
}
