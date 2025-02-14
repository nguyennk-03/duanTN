<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ThemSanPhamRequest extends FormRequest
{
    /**
     * Xác thực quyền thực hiện request
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Quy tắc validation
     */
    public function rules()
    {
        return [
            'tensp' => 'required|string|max:255',
            'giaban' => 'required|numeric|min:0|max:9999999999',
            'giagiam' => 'nullable|numeric|min:0|lte:giaban',
            'mota' => 'nullable|string',
            'soluong' => 'required|integer|min:0',
            'danhmuc_id' => 'required|exists:danhmuc,id',
            'thuonghieu_id' => 'required|exists:thuonghieu,id',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Xử lý lỗi validation trả về JSON
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            'errors' => $errors->messages(),
        ], Response::HTTP_BAD_REQUEST);
        throw new HttpResponseException($response);
    }
}
