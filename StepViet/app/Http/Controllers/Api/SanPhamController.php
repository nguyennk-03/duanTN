<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\SanPhamResource;

class SanPhamController extends Controller
{
    // 📌 Lấy danh sách sản phẩm với bộ lọc
    public function index(Request $request)
    {
        try {
            $query = SanPham::query();

            if ($request->has('danhmuc')) {
                $query->where('danhmuc', $request->danhmuc);
            }
            if ($request->has('thuonghieu')) {
                $query->where('thuonghieu', $request->thuonghieu);
            }
            if ($request->has('GiaBan_min') && $request->has('GiaBan_max')) {
                $query->whereBetween('GiaBan', [$request->GiaBan_min, $request->GiaBan_max]);
            }

            $sanpham = $query->latest('MaSP')->paginate($request->input('per_page', 5));

            return response()->json([
                'message' => 'Danh sách sản phẩm',
                'data' => SanPhamResource::collection($sanpham)
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi Server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // 📌 Thêm sản phẩm mới
    public function store(Request $request)
    {
        try {
            $sanphamData = $request->only(['TenSP', 'GiaBan', 'GiaGiam', 'MoTa', 'SoLuong', 'danhmuc', 'thuonghieu']);

            // Xử lý upload ảnh
            if ($request->hasFile('IMG')) {
                $sanphamData['IMG'] = $request->file('IMG')->store('images/sanpham', 'public');
            }

            $sanpham = SanPham::create($sanphamData);

            return response()->json([
                'message' => 'Sản phẩm đã được tạo thành công',
                'data' => new SanPhamResource($sanpham)
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi Server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // 📌 Lấy chi tiết sản phẩm
    public function show($id)
    {
        try {
            $sanpham = SanPham::findOrFail($id);
            return response()->json([
                'message' => 'Chi tiết sản phẩm',
                'data' => new SanPhamResource($sanpham)
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], Response::HTTP_NOT_FOUND);
        }
    }

    // 📌 Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        try {
            $sanpham = SanPham::find($id);
            if (!$sanpham) {
                return response()->json(['message' => 'Sản phẩm không tồn tại'], Response::HTTP_NOT_FOUND);
            }

            $sanphamData = $request->only(['TenSP', 'GiaBan', 'GiaGiam', 'MoTa', 'SoLuong', 'danhmuc', 'thuonghieu']);

            // Xử lý upload ảnh mới (nếu có)
            if ($request->hasFile('IMG')) {
                if ($sanpham->IMG) {
                    Storage::disk('public')->delete($sanpham->IMG);
                }
                $sanphamData['IMG'] = $request->file('IMG')->store('images/sanpham', 'public');
            }

            $sanpham->update($sanphamData);

            return response()->json([
                'message' => 'Sản phẩm đã được cập nhật thành công',
                'data' => new SanPhamResource($sanpham)
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi Server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // 📌 Xóa sản phẩm (Soft Delete)
    public function destroy($id)
    {
        try {
            $sanpham = SanPham::find($id);
            if (!$sanpham) {
                return response()->json(['message' => 'Sản phẩm không tồn tại'], Response::HTTP_NOT_FOUND);
            }

            $sanpham->delete();

            return response()->json(['message' => 'Sản phẩm đã được đưa vào thùng rác'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi Server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // 📌 Xuất danh sách sản phẩm ra file JSON
    public function exportJson()
    {
        try {
            $sanpham = SanPham::all();
            $jsonData = json_encode(SanPhamResource::collection($sanpham), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            $filePath = 'sanpham.json';
            Storage::disk('public')->put($filePath, $jsonData);

            return response()->download(storage_path("app/public/" . $filePath));
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi Server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
