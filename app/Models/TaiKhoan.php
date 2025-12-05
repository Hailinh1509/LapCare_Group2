<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VaiTro;
class TaiKhoan extends Model
{
    protected $table = 'taikhoan';
    protected $primaryKey = 'matk';
    public $timestamps = false;
        public $incrementing = false;  // QUAN TRỌNG
    protected $keyType = 'string'; // QUAN TRỌNG
    protected $fillable = [
        'tentk',
        'sdt',
        'gmail',
        'diachi',
        'makthau',
        'mavt'
    ];

    // Quan hệ đúng: khách hàng thuộc 1 vai trò
    public function vaitro()
    {
        return $this->belongsTo(VaiTro::class, 'mavt', 'mavt');
    }

    // Quan hệ đánh giá: 1 khách hàng có nhiều đánh giá
    public function danhgia()
    {
        return $this->hasMany(DanhGia::class, 'matk', 'matk');
    }
}


