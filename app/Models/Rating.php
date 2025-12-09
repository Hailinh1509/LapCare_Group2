<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'danhgia'; // tên bảng trong CSDL
    protected $primaryKey = 'id'; // khóa chính
    public $timestamps = false; // nếu bảng dùng 'ngaytao' và 'ngaysua' thay vì created_at, updated_at

    protected $fillable = [
        'matk',
        'masp',
        'ngaytao',
        'ngaysua',
        'noidung',
        'rating',
        'mahd',
    ];
}
