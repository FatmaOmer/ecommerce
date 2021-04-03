<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'=>'required',
            'type'=>'required|in 1,2',
            'slug'=> 'required|unique:categories,slug'.$this->category

        ];
    }
    public function messages()
    {
        return [
            'name.required' => trans('admin/categories.namere'),
            'slug.required' => trans('admin/categories.slugre'),
            'slug.unique' => trans('admin/categories.slugun'),


        ];
    }
}
