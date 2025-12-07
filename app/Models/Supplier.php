<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'nhacungcap';          // tên bảng
    protected $primaryKey = 'mancc';          // khóa chính
    public $incrementing = false;             // nếu mancc không auto increment
    protected $keyType = 'string';            // kiểu khóa chính

    // Laravel tự động cập nhật trường ngày tạo / ngày sửa
    const CREATED_AT = 'ngaytao';
    const UPDATED_AT = 'ngaysua';
    public $timestamps = true;

    protected $fillable = [
        'mancc', 'tenncc', 'diachi', 'sdt', 'email', 'ghichu'
    ];

    // ============================
    //   CUSTOM ACCESSORS
    // ============================

    public function getSdtFormattedAttribute()
    {
        return $this->attributes['sdt'] ?? '';
    }

    public function getEmailAttribute($value)
    {
        return $value ?? '';
    }

    // ============================
    //   RELATIONSHIPS
    // ============================
    // Một nhà cung cấp có thể cung cấp nhiều sản phẩm
    public function products()
    {
        return $this->hasMany(Product::class, 'mancc', 'mancc');
    }
}
