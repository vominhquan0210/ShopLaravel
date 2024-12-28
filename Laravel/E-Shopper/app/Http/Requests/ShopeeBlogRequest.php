<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopeeBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'tittle' => 'required',
           'avatar' => 'image|mimes:jpeg ,png,jpg,gif|max:1024',
           'description' => 'required',
           'content'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute phải có đuôi là jpeg ,png,jpg,gif',
            'max' => ':attribute không được vượt quá :max ký tự',

        ];
    }

    public function attributes()
    {
        return [
            'tittle' => 'Tiêu đề',
            'avatar' => 'Ảnh',
            'description' => 'Mô tả',
            'content' => 'Nội dung',
        ];
    }
}
