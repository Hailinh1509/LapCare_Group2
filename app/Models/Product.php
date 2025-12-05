<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'sanpham';
    protected $primaryKey = 'masp'; // khai báo primary key đúng
    public $incrementing = false;   // vì masp không tự tăng (nếu đúng)
    protected $keyType = 'string';  // nếu masp là chuỗi hoặc varchar
    public $timestamps = false;

    protected $fillable = [
        'masp', 'tensp', 'maloaisp', 'hinhanh', 'soluong', 'giasp', 'mota', 
        'manhinh', 'ram', 'cpu', 'ocung', 'hang', 'thoigian', 'ngaytao', 
        'ngaysua', 'khuyenmai'
    ];
}
