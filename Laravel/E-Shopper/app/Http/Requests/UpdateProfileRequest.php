<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Xác thực người dùng có được phép gửi yêu cầu không.
     */
    public function authorize(): bool
    {
        return true; // Cho phép gửi yêu cầu
    }

    /**
     * Quy tắc xác thực.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
    }

    /**
     * Thông báo lỗi tùy chỉnh.
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute phải là email hợp lệ',
            'max' => ':attribute không được vượt quá :max ký tự',
            'image' => ':attribute phải là một tệp hình ảnh',
            'mimes' => ':attribute phải là một trong các định dạng: jpeg, png, jpg, gif',
        ];
    }


    public function attributes(): array
    {
        return [
            'name' => 'Tên người dùng',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'avatar' => 'Ảnh đại diện',
        ];
    }


}
