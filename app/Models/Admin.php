<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    
    protected $primaryKey = 'id_admin';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_admin', 'nama_admin', 'kontak'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::orderBy('id_admin', 'desc')->first();
            $number = $latest ? intval(substr($latest->id_admin, 2)) + 1 : 1;
            $model->id_admin = 'AD' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }
    
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_admin', 'id_admin');
    }
}
