<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class ThemDanhMucRequest extends FormRequest
{
    /**
     * Xác định người dùng có quyền gửi request hay không.
     */
    public function authorize(): bool
    {
        return true; // Nếu cần kiểm tra quyền, có thể thay đổi thành $this->user()->isAdmin();
    }

    /**
     * Quy tắc validation cho request.
     */
    public function rules(): array
    {
        return [
            'tendm' => 'required|string|max:255|unique:danhmuc,tendm',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi (không bắt buộc).
     */
    public function messages(): array
    {
        return [
            'tendm.required' => 'Tên danh mục không được để trống.',
            'tendm.string' => 'Tên danh mục phải là chuỗi ký tự.',
            'tendm.max' => 'Tên danh mục không được quá 255 ký tự.',
            'tendm.unique' => 'Tên danh mục đã tồn tại.',
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            'errors' => $errors->messages(),
        ], Response::HTTP_BAD_REQUEST);
        throw new HttpResponseException($response);
    }
}
