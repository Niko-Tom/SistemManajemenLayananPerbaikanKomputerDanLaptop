<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    
    protected static function getAll()
    {
        return Pelanggan::all();
    }

    public static function find($id)
    {
        return Pelanggan::where('id', $id)->first();
    }
}