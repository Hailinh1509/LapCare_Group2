<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    protected $table = 'sanpham';
    protected $primaryKey = 'masp';
    public $timestamps = false;

    public function loai()
    {
        return $this->belongsTo(loaisp::class, 'maloaisp');
    }
}
