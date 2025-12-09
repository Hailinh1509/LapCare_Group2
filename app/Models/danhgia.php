<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = 'danhgia';        // tên bảng
    protected $primaryKey = 'id';        // khóa chính
    
    public $timestamps = false;          
    
    protected $fillable = [
        'matk',
        'masp',
        'noidung',
        'rating'
    ];

    // ============================
    // QUAN HỆ: Tài khoản đánh giá
    // ============================
    public function taikhoan()
    {
        return $this->belongsTo(User::class, 'matk', 'id')
                    ->withDefault();     // tránh lỗi khi user bị xóa
    }

    // ============================
    // QUAN HỆ: Sản phẩm được đánh giá
    // ============================
    public function product()
    {
        return $this->belongsTo(Product::class, 'masp', 'masp');
    }
}
