<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController; 
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/women', [HomeController::class, 'women'])->name('women');
Route::get('/men', [HomeController::class, 'men'])->name('men');
Route::get('/kids', [HomeController::class, 'kids'])->name('kids');
Route::get('/technologies', [HomeController::class, 'technologies'])->name('technologies');
Route::get('/sale', [HomeController::class, 'sale'])->name('sale');
Route::get('/collection', [HomeController::class, 'collection'])->name('collection');



Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

Route::get('/search', [SanPhamController::class, 'search'])->name('products.search');
Route::get('/sanpham', [SanPhamController::class, 'index']);
Route::get('/sanpham/{id}', [SanPhamController::class, 'show']);
Route::post('/sanpham', [SanPhamController::class, 'store']);

Route::get('/products/detail/{product_id}', [SanPhamController::class, 'detail'])->name('productsdetail');

Route::get('/categories/{category_id}', [SanPhamController::class, 'products'])->name('productByCategoryId');

Route::get('/category', [DanhMucController::class, 'list'])->name('category');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/adminSP', [AdminController::class, 'adminSP'])->name('adminSP');
Route::get('/adminDM', [AdminController::class, 'adminDM'])->name('adminDM');
Route::get('/adminND', [AdminController::class, 'adminND'])->name('adminND');

Route::post('/productadd', [AdminController::class, 'productadd'])->name('productadd');
Route::get('/productdelete/{id}', [AdminController::class, 'productdelete'])->name('productdelete');
Route::get('/productupdateform/{id}', [AdminController::class, 'productupdateform'])->name('productupdateform');
Route::put('/productupdate/{id}', [AdminController::class, 'productupdate'])->name('productupdate');
Route::get('/update', [AdminController::class, 'update'])->name('update');