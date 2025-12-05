<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VaiTro;

class TaiKhoan extends Model
{
    protected $table = 'taikhoan';

    protected $primaryKey = 'matk';

    public $timestamps = false;

    protected $fillable = [
        'tentk',
        'sdt',
        'gmail',
        'diachi',
        'matkhau',
        'mavt'
    ];

    public function danhgia()
    {
        return $this->belongsTo(VaiTro::class, 'mavt', 'mavt');
    }
}
