<?php
//file này là bình tĩnh đừng xoá! QUỲNH ANH đang xem xét
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    protected $table = 'sanpham';
    protected $primaryKey = 'masp';
    public $incrementing = false;   // vì masp là varchar
    protected $keyType = 'string';
    public $timestamps = false;

    public function loai()
    {
        return $this->belongsTo(loaisp::class, 'maloaisp');
    }
}
