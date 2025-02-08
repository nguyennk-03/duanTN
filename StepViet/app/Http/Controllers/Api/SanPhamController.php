<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SanPhamController extends Controller
{
    // Lấy danh sách sản phẩm
    public function index(Request $request)
    {
        $data = SanPham::query()->latest('MaSP')->paginate(5);
        return response()->json([
            'message' => 'Danh sach san pham trang .' . request('page', 1),
            'data' => $data
        ]);
    }

    // Thêm sản phẩm mới (yêu cầu đăng nhập)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TenSP' => 'required|string|max:255',
            'GiaBan' => 'required|numeric|min:0',
            'GiaGiam' => 'nullable|numeric|min:0',
            'MoTa' => 'nullable|string',
            'IMG' => 'nullable|string',
            'SoLuong' => 'required|integer|min:0',
            'danhmuc' => 'required|exists:danhmuc,MaDM',
            'thuonghieu' => 'required|exists:thuonghieu,MaTH',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = SanPham::create($request->all());
        return response()->json(['message' => 'data created successfully', 'data' => $data], 201);
    }

    // Lấy chi tiết sản phẩm
    public function show(string $id)
    {
        try {
            $data = SanPham::query()->findOrFail($id);
            return response()->json([
                'message' => 'Chi tiết sản phẩm id = ' . request('page', 1),
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__ , [
                'message' => $th->getMessage(), 
                'line' => $th->getLine(), 
                'file' => $th->getFile()
            ]);
            if ($th instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json(['message' => 'Không tìm thấy sản phẩm'], Response::HTTP_NOT_FOUND);
            } else {
                return response()->json(['message' => 'Lỗi Sever'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $data = SanPham::find($id);
        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'TenSP' => 'sometimes|required|string|max:255',
            'GiaBan' => 'sometimes|required|numeric|min:0',
            'GiaGiam' => 'nullable|numeric|min:0',
            'MoTa' => 'nullable|string',
            'IMG' => 'nullable|string',
            'SoLuong' => 'sometimes|required|integer|min:0',
            'danhmuc' => 'sometimes|required|exists:danhmuc,MaDM',
            'thuonghieu' => 'sometimes|required|exists:thuonghieu,MaTH',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data->update($request->all());
        return response()->json(['message' => 'data updated successfully', 'data' => $data]);
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $data = SanPham::find($id);
        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }
        $data->delete();
        return response()->json(['message' => 'data deleted successfully']);
    }

    // Xuất danh sách sản phẩm ra file JSON
    public function exportJson()
    {
        $sanpham = SanPham::all();
        $jsonData = json_encode($sanpham, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $filePath = 'sanpham.json';
        Storage::disk('public')->put($filePath, $jsonData);

        return response()->download(storage_path("app/public/" . $filePath));
    }
}
