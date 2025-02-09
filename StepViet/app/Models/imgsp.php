<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imgsp extends Model
{
    use HasFactory;

    protected $table = 'imgsp';

    protected $fillable = [
        'sanpham_id',
        'duongdan',
    ];
}
