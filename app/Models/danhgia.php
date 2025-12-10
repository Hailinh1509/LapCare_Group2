<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SanPham;

class DanhGia extends Model
{
    protected $table = 'danhgia';      // tên bảng
    protected $primaryKey = 'id';      // khóa chính
    public $timestamps = false;        // không tự động timestamps
    
    protected $fillable = [
        'matk',
        'masp',
        'noidung',
        'rating',
        'ngaytao'
    ];


    // ============================
    // QUAN HỆ: Tài khoản đánh giá
    // ============================
    public function user()
    {
        return $this->belongsTo(User::class, 'matk', 'matk')->withDefault();
    }

    // ============================
    // QUAN HỆ: Sản phẩm được đánh giá
    // ============================
    public function sanpham()
    {
        return $this->belongsTo(sanpham::class, 'masp', 'masp')->withDefault();
    }
}
