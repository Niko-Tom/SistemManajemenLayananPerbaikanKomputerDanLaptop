<?php

namespace Database\Factories;

use App\Models\Transaksi;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    protected $model = Transaksi::class;

    public function definition(): array
    {
        return [
            'id_admin' => Admin::inRandomOrder()->first()->id_admin,
            'total_harga' => $this->faker->numberBetween(100000, 1000000),
        ];
    }
}
