<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController; 
use App\Http\Controllers\Api\SanPhamController;
use App\Http\Controllers\Api\DanhMucController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/save', [ApiController::class, 'saveApiToJson']);
Route::apiResource('/sanpham', SanPhamController::class);
Route::apiResource('/danhmuc', DanhmucController::class);
