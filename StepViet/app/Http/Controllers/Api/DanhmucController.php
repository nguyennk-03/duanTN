<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ThemDanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\DanhMucResource;

class DanhmucController extends Controller
{
    // Lấy danh sách danh mục với bộ lọc
    public function index(Request $request)
    {
        try {
            $danhmuc = DanhMuc::query()
                ->when($request->filled('ten'), fn($query) => $query->where('ten', 'like', "%{$request->ten}%"))
                ->when($request->trashed === 'only', fn($query) => $query->onlyTrashed())
                ->when($request->trashed === 'with', fn($query) => $query->withTrashed())
                ->latest('id')
                ->paginate($request->input('perpage', 2));

            return response()->json([
                'message' => 'Lấy danh sách danh mục thành công',
                'data' => DanhMucResource::collection($danhmuc),
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('DanhmucController@index', ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi server khi lấy danh mục'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Thêm danh mục mới
    public function store(ThemDanhMucRequest $request)
    {
        try {
            $danhmuc = DanhMuc::create($request->validated());

            return response()->json([
                'message' => 'Tạo mới danh mục thành công',
                'data' => new DanhMucResource($danhmuc),
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error('DanhmucController@store', ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi khi tạo danh mục, vui lòng thử lại'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Lấy chi tiết danh mục
    public function show($id)
    {
        try {
            $danhmuc = DanhMuc::findOrFail($id);
            return response()->json([
                'message' => 'Lấy chi tiết danh mục thành công',
                'data' => new DanhMucResource($danhmuc),
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error("DanhmucController@show", ['id' => $id, 'error' => $th->getMessage()]);
            return response()->json(['message' => "Không tìm thấy danh mục có ID {$id}"], Response::HTTP_NOT_FOUND);
        }
    }

    // Cập nhật danh mục
    public function update(Request $request, $id)
    {
        try {
            $danhmuc = DanhMuc::findOrFail($id);
            $danhmuc->update($request->validate([
                'tendm' => 'sometimes|string|max:255',
            ]));

            return response()->json([
                'message' => 'Cập nhật danh mục thành công',
                'data' => new DanhMucResource($danhmuc),
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error("DanhmucController@update", ['id' => $id, 'error' => $th->getMessage()]);
            return response()->json(['message' => "Lỗi khi cập nhật danh mục có ID {$id}"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Xóa danh mục (Soft Delete)
    public function destroy($id)
    {
        try {
            $danhmuc = DanhMuc::findOrFail($id);
            $danhmuc->delete();

            return response()->json([
                'message' => "Danh mục có ID {$id} đã được xóa thành công",
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error("DanhmucController@destroy", ['id' => $id, 'error' => $th->getMessage()]);
            return response()->json(['message' => "Không tìm thấy danh mục có ID {$id} để xóa"], Response::HTTP_NOT_FOUND);
        }
    }

    // Xuất danh sách danh mục ra file JSON
    public function exportJson()
    {
        try {
            $danhmuc = DanhMuc::select('id', 'ten', 'mota')->get();
            return response()->json([
                'message' => 'Xuất danh sách danh mục thành công',
                'data' => $danhmuc,
            ], Response::HTTP_OK, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            Log::error("DanhmucController@exportJson", ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Lỗi server khi xuất danh mục'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
