<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhaCungCap extends Model
{
    protected $table = 'nhacungcap'; // tên bảng đúng
    protected $primaryKey = 'mancc';
    public $incrementing = false; 
    protected $keyType = 'string';

    public $timestamps = false; // nếu bảng không có created_at / updated_at

    protected $fillable = [
        'mancc',
        'tenncc',
        'sdt',
        'gmail',
        'diachi',
    ];
}
