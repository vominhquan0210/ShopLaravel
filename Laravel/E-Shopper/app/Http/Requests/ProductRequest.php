<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:25|string',
            'price' => 'required|numeric',
            'sale' => 'numeric|max:3',
            'company' => 'required|string',
            'image' => 'image|mimes:jpeg ,png,jpg,gif|max:1024',
            'detail' => 'required|string|max:200'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là một chuỗi',
            'max' => ':attribute không quá :max kí tự',
            'numeric' => ':attribute phải là số',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute có đuôi không hợp lệ',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên product',
            'price' => 'Giá product',
            'sale' => 'Giá sale',
            'company' => 'Công ty',
            'image' => 'Ảnh',
            'detail' => 'Chi tiết'
        ];
    }
}
