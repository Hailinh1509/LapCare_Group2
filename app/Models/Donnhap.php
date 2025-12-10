<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donnhap extends Model
{
    protected $table = 'donnhap';
    protected $primaryKey = 'madn';
    public $incrementing = false;   // VÌ madn là VARCHAR, KHÔNG PHẢI AUTO ID
    protected $keyType = 'string';  // BẮT BUỘC
    public $timestamps = false;
protected $fillable = [
    'madn', 'mancc', 'matk', 'ngaynhap', 'ttthanhtoan'
];
    public function ncc()
    {
        return $this->belongsTo(NhaCungCap::class, 'mancc', 'mancc');
    }

    public function chitiet()
    {
        return $this->hasMany(Chitietdonnhap::class, 'madn', 'madn');
    }
     public function user()
{
    return $this->belongsTo(User::class, 'matk', 'matk');
}
}
