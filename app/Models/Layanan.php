<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_layanan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_layanan', 'id_pelanggan', 'jenis_kerusakan', 'tanggal_masuk', 'catatan', 'harga'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::orderBy('id_layanan', 'desc')->first();
            $number = $latest ? intval(substr($latest->id_layanan, 2)) + 1 : 1;
            $model->id_layanan = 'LY' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'id_layanan', 'id_layanan');
    }
}
