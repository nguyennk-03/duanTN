<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $primaryKey = 'MaSP';
    public $timestamps = true;

    protected $fillable = ['TenSP', 'MoTa', 'GiaBan', 'GiaGiam', 'SoLuong', 'MaDM', 'MaTH', 'IMG'];

    protected $casts = [
        'GiaBan' => 'decimal:2',
        'GiaGiam' => 'decimal:2',
        'SoLuong' => 'integer',
    ];

    public function danhmuc()
    {
        return $this->belongsTo(DanhMuc::class, 'MaDM', 'MaDM');
    }

    public function thuonghieu()
    {
        return $this->belongsTo(ThuongHieu::class, 'MaTH', 'MaTH');
    }
}
