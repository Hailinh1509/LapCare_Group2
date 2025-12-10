<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\loaisp;

class Product extends Model
{
    protected $table = 'sanpham';
    protected $primaryKey = 'masp'; 
    public $incrementing = false;
    protected $keyType = 'string';

    // Laravel sẽ tự động cập nhật ngaytao/ngaysua
    const CREATED_AT = 'ngaytao';
    const UPDATED_AT = 'ngaysua';
    public $timestamps = true; // Chỉ khai báo một lần

    protected $fillable = [
        'masp','tensp','maloaisp','hinhanh','soluong','giasp',
        'mota','manhinh','ram','cpu','ocung','hang','thoigian','khuyenmai'
    ];

    public function getGiaspFormattedAttribute()
    {
        return number_format((int)$this->attributes['giasp'], 0, ',', '.');
    }

    public function getKhuyenmaiAttribute($value)
    {
        return $value ?? 0;
    }

    public function loai()
    {
        return $this->belongsTo(loaisp::class, 'maloaisp', 'maloaisp');
    }
}
