<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ImgSp;


class SanPham extends Model{
    
    use HasFactory;

    protected $table = 'sanpham';

    protected $fillable = [
        'TenSP', 'MoTa', 'GiaBan', 'GiaGiam', 'SoLuong', 'danhmuc', 'MaTH',
    ];

    public function images()
    {
        return $this->hasMany(ImgSP::class, 'MaSP', 'MaSP');
    }
}