<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    use HasFactory;
    protected $table = 'thuonghieu';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['tenth'];

    public function sanphams()
    {
        return $this->hasMany(SanPham::class, 'thuonghieu_id', 'id');
    }
}
