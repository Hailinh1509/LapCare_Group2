<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sanpham;

class Chitietdonnhap extends Model
{
    protected $table = 'chitietdonnhap';
    public $timestamps = false;

    protected $fillable = [
        'madn',
        'masp',
        'soluong',
        'gianhap',
    ];

    public function product()
    {
        return $this->belongsTo(Sanpham::class, 'masp', 'masp');
    }
}
