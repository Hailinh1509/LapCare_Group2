<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vaitro;
class Nhanvien extends Model
{
    protected $table = 'nhanvien';
    protected $primaryKey = 'manv';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function vaitro()
    {
        return $this->belongsTo(Vaitro::class, 'mavt', 'mavt');
    }
}
