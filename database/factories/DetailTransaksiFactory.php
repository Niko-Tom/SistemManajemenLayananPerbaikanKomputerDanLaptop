<?php

namespace Database\Factories;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailTransaksi>
 */
class DetailTransaksiFactory extends Factory
{
    protected $model = DetailTransaksi::class;

    public function definition(): array
    {
        static $index = 0;

        $transaksiIds = Transaksi::orderBy('id_transaksi')->pluck('id_transaksi');

        if (!isset($transaksiIds[$index])) {
            return [];
        }

        return [
            'id_transaksi' => $transaksiIds[$index++],
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
