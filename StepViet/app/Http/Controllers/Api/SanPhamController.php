<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ThemSanPhamRequest;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\SanPhamResource;

class SanPhamController extends Controller
{
    // Lấy danh sách sản phẩm với bộ lọc
    public function index(Request $request)
    {
        try {
            $sanpham = SanPham::query()
                ->when($request->danhmuc, fn($query, $value) => $query->where('danhmuc_id', $value))
                ->when($request->thuonghieu, fn($query, $value) => $query->where('thuonghieu_id', $value))
                ->when($request->giabanmin, fn($query, $value) => $query->where('giaban', '>=', $value))
                ->when($request->giabanmax, fn($query, $value) => $query->where('giaban', '<=', $value))
                ->when($request->trashed === 'only', fn($query) => $query->onlyTrashed())
                ->when($request->trashed === 'with', fn($query) => $query->withTrashed())
                ->latest('id')
                ->paginate($request->input('perpage', 5));

            return response()->json([
                'message' => 'Danh sách sản phẩm',
                'sanpham' => SanPhamResource::collection($sanpham),
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('SanPhamController@index', ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Thêm sản phẩm mới
    public function store(ThemSanPhamRequest $request)
    {
        try {
            $sanpham = SanPham::create($request->validated());

            return response()->json([
                'message' => 'Tạo mới sản phẩm thành công',
                'sanpham' => new SanPhamResource($sanpham),
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error('SanPhamController@store', ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi khi tạo sản phẩm'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Lấy chi tiết sản phẩm
    public function show($id)
    {
        try {
            $sanpham = SanPham::findOrFail($id);
            return response()->json([
                'message' => 'Chi tiết sản phẩm',
                'data' => new SanPhamResource($sanpham),
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error("SanPhamController@show", ['id' => $id, 'error' => $th->getMessage()]);
            return response()->json(['message' => "Không tìm thấy sản phẩm"], Response::HTTP_NOT_FOUND);
        }
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        try {
            $sanpham = SanPham::findOrFail($id);
            $sanpham->update($request->validate([
                'tensp' => 'sometimes|string|max:255',
                'mota' => 'sometimes|string',
                'giaban' => 'sometimes|numeric|min:0',
                'giagiam' => 'sometimes|numeric|min:0',
                'soluong' => 'sometimes|integer|min:0',
                'danhmuc_id' => 'sometimes|exists:danhmuc,id',
                'thuonghieu_id' => 'sometimes|exists:thuonghieu,id',
                'img' => 'sometimes|url',
            ]));

            return response()->json([
                'message' => 'Cập nhật sản phẩm thành công',
                'sanpham' => new SanPhamResource($sanpham),
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error("SanPhamController@update", ['id' => $id, 'error' => $th->getMessage()]);
            return response()->json(['message' => "Lỗi khi cập nhật sản phẩm"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Xóa sản phẩm (Soft Delete)
    public function destroy($id)
    {
        try {
            $sanpham = SanPham::findOrFail($id);
            $sanpham->delete();

            return response()->json(['message' => 'Sản phẩm đã được xóa'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error("SanPhamController@destroy", ['id' => $id, 'error' => $th->getMessage()]);
            return response()->json(['message' => "Không tìm thấy sản phẩm"], Response::HTTP_NOT_FOUND);
        }
    }

    // Xuất danh sách sản phẩm ra file JSON
    public function exportJson()
    {
        try {
            $sanpham = SanPham::select('id', 'tensp', 'giaban', 'giagiam', 'soluong')->get();
            $jsonData = json_encode($sanpham, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $filePath = 'sanpham.json';

            Storage::disk('public')->put($filePath, $jsonData);
            return response()->download(storage_path("app/public/" . $filePath));
        } catch (\Throwable $th) {
            Log::error("SanPhamController@exportJson", ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi server'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
