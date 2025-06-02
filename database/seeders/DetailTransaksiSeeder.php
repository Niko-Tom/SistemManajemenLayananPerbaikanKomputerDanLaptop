<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use Illuminate\Database\Seeder;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailTransaksi::factory()->count(10)->create();
    }
}
