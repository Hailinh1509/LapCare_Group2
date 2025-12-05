<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    protected $table = 'vaitro';
    protected $primaryKey = 'mavt';
    public $timestamps = false;

    protected $fillable = ['tenvt', 'mota'];
}
