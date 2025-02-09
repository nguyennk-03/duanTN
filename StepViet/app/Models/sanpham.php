<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'sanpham';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'tensp',
        'giaban',
        'giagiam',
        'mota',
        'soluong',
        'danhmuc_id',
        'thuonghieu_id',
        'img'
    ];
    protected $casts = [
        'giaban' => 'decimal:2',
        'giagiam' => 'decimal:2',
        'soluong' => 'integer',
    ];

    public function danhmuc()
    {
        return $this->belongsTo(DanhMuc::class, 'danhmuc_id');
    }

    public function thuonghieu()
    {
        return $this->belongsTo(ThuongHieu::class, 'thuonghieu_id');
    }
}
