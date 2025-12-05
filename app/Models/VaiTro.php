<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaitro extends Model
{
    protected $table = 'vaitro';
    protected $primaryKey = 'mavt';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
}
