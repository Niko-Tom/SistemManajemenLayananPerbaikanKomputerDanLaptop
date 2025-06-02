<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_detail', 'id_transaksi', 'keterangan'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::orderBy('id_detail', 'desc')->first();
            $number = $latest ? intval(substr($latest->id_detail, 2)) + 1 : 1;
            $model->id_detail = 'DT' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
