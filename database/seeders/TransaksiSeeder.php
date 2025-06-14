<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\Transaksi;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $jumlah = min(Pelanggan::count(), Layanan::count());

        // Ambil hanya admin dengan ID AD0001 sampai AD0005
        $adminIds = Admin::whereIn('id_admin', [
            'AD0001', 'AD0002', 'AD0003', 'AD0004', 'AD0005'
        ])->pluck('id_admin')->toArray();

        for ($i = 0; $i < $jumlah; $i++) {
            $pelanggan = Pelanggan::skip($i)->first();
            $layanan = Layanan::skip($i)->first();
            $adminId = fake()->randomElement($adminIds);

            // Generate ID transaksi unik
            $latest = Transaksi::orderBy('id_transaksi', 'desc')->first();
            $number = $latest ? intval(substr($latest->id_transaksi, 2)) + 1 : 1;
            $id_transaksi = 'TR' . str_pad($number, 4, '0', STR_PAD_LEFT);

            Transaksi::create([
                'id_transaksi' => $id_transaksi,
                'id_pelanggan' => $pelanggan->id,
                'id_layanan' => $layanan->id_layanan,
                'id_admin' => $adminId,
                'total_harga' => fake()->numberBetween(100_000, 1_000_000),
            ]);
        }
    }
}
