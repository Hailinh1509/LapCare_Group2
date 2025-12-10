<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donnhap extends Model   
{
    protected $table = 'donnhap';
    protected $primaryKey = 'madn';
    public $timestamps = false;

    public function ncc()
    {
        return $this->belongsTo(NhaCungCap::class, 'mancc', 'mancc');
    }

    public function chitiet()
    {
        return $this->hasMany(Chitietdonnhap::class, 'madn', 'madn');
    }
}
