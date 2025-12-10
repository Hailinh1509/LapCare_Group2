<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class DonHang extends Model
{
    use HasFactory;

    protected $table = 'donhang'; // Tên bảng trong DB

    protected $primaryKey = 'madh'; // Khóa chính

    public $incrementing = false; // Nếu madh là string

    protected $keyType = 'string';

    protected $fillable = [
        'madh',
        'matk',
        'ngaydat',
        'diachigiaohang',
        'phivanchuyen',
        'VAT',
        'pttt',
        'ttthanhtoan',
        'ttvanchuyen',
        'ghichu'
    ];

    // Nếu muốn tự động tạo timestamps
    public $timestamps = true;

    public function chitiet()
    {
        return $this->hasMany(ChiTietDonHang::class, 'mahd', 'madh');

    }
    public function user()
{
    return $this->belongsTo(User::class, 'matk', 'matk');
}

}
