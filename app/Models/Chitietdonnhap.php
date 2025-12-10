<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChitietDonNhap extends Model
{
    protected $table = 'chitietdonnhap';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(SanPham::class, 'masp', 'masp');
    }
}


