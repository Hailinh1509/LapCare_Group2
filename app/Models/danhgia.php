<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaiKhoan;
use App\Models\sanpham;

class danhgia extends Model
{
    protected $table = 'danhgia';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'matk', 'masp', 'noidung', 'rating'
    ];

    public function taikhoan()
    {
        //return $this->belongsTo(TaiKhoan::class, 'matk', 'matk');
        return $this->belongsTo(TaiKhoan::class, 'matk', 'matk')
        ->withDefault(); 
    }

    public function sanpham()
    {
        return $this->belongsTo(sanpham::class, 'masp', 'masp');
    }
}