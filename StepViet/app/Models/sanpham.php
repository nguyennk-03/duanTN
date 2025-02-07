<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'sanpham';
    protected $primaryKey = 'MaSP'; // Định nghĩa khóa chính
    public $timestamps = false; // Nếu không có created_at và updated_at

    protected $fillable = [
        'TenSP', 'MoTa', 'GiaBan', 'GiaGiam', 'SoLuong', 'danhmuc', 'MaTH',
    ];

    public function images()
    {
        return $this->hasMany(ImgSP::class, 'MaSP', 'MaSP'); // Quan hệ với ImgSP
    }
}
?>