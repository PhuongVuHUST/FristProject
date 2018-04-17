<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'tags.*' => 'required',
            'category_id' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
        ];
    }
    public function messages(){
        return[
            'title.required' => 'Tiêu đề không được bỏ trống!',
            'description.required' => 'Mô tả không được bỏ trống!',
            'content.required' => 'Nội dung không được bỏ trống!',
            'tags.*.required' => 'Tags không được bỏ trống!',
            'category_id.required' => 'Danh mục không được bỏ trống!',
            'image.mimes' => 'image phải là ảnh (jpg, jpeg, png)!',
        ]
    }
}
