<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chitietdonhang';
    public $timestamps = false;
    public $incrementing = false; // vì không có khóa chính tự tăng
    protected $primaryKey = null;

    protected $fillable = [
        'mahd',
        'masp',
        'soluong',
        'dongia',
    ];
 
    public function donhang()
    {
        return $this->belongsTo(DonHang::class, 'mahd', 'madh');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'masp', 'masp');
    }

}
