<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    protected $table = 'giohang';

    protected $fillable = [
        'matk', 'masp', 'soluong', 'ngaychon'
    ];

    public $timestamps = false;
}