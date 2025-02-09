<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;

    protected $table = 'danhmuc';
    protected $primaryKey = 'id'; 
    public $timestamps = true;
    
    protected $fillable = ['tendm'];

    public function sanphams()
    {
        return $this->hasMany(SanPham::class, 'danhmuc_id', 'id'); 
    }
}

