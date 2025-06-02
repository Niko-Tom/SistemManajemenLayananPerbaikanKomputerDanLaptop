<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';
    
    protected $fillable = ['nama', 'email', 'telepon', 'keluhan'];

    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'id_pelanggan', 'id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan', 'id');
    }

    protected static function getAll()
    {
        return Pelanggan::all();
    }

    public static function find($id)
    {
        return Pelanggan::where('id', $id)->first();
    }
}
