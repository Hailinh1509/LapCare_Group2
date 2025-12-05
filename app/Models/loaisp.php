<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loaisp extends Model
{
    protected $table = 'loaisp';
    protected $primaryKey = 'maloaisp';
    public $timestamps = false;
    protected $fillable = [
        'maloaisp',
        'tenloaisp',
        'ngaytao'
    ];
    public function loaisp()
{
    return $this->hasMany(sanpham::class, 'maloaisp', 'maloaisp');
}
}
