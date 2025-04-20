<?php

namespace App\Models;

class Pelanggan
{
    protected static function getDummyData()
    {
        return [
            [
            'id' => 1, 
            'nama' => 'Nikolaus Thomas', 
            'email' => 'nikolaus@email.com', 
            'telepon' => '0812345678', 
            'keluhan' => 'LCD Bergaris-garis'],
            [
            'id' => 2, 
            'nama' => 'Bagus Winata', 
            'email' => 'bagus@email.com', 
            'telepon' => '0898765432', 
            'keluhan' => 'Kipas Internal Tidak Berputar'],
            [
            'id' => 3, 
            'nama' => 'Christiano Immanuel', 
            'email' => 'christiano@email.com', 
            'telepon' => '0822334455', 
            'keluhan' => 'Ganti Keyboard Internal'],
            [
            'id' => 4, 
            'nama' => 'Ade Khudori', 
            'email' => 'Ade@email.com', 
            'telepon' => '08987645343', 
            'keluhan' => 'Ganti Keyboard Internal'],
            [
            'id' => 5, 
            'nama' => 'Sahl Firdaus', 
            'email' => 'Sahl@email.com', 
            'telepon' => '0852874920', 
            'keluhan' => 'Kipas Internal Tidak Berputar'],
            [
            'id' => 6, 
            'nama' => 'Satria Ahmad Roif', 
            'email' => 'Roif@email.com', 
            'telepon' => '08123678241', 
            'keluhan' => 'Ganti Thermal Paste'],
        ];
    }

    public static function all()
    {
        return self::getDummyData();
    }

    public static function find($id)
    {
        $pelanggan = self::getDummyData();
        foreach ($pelanggan as $pelanggan) {
            if ($pelanggan['id'] == $id) {
                return $pelanggan;
            }
        }
        return null;
    }
}