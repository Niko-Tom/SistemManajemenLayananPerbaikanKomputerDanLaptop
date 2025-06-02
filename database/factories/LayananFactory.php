<?php

namespace Database\Factories;

use App\Models\Layanan;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Layanan>
 */
class LayananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Layanan::class;
    
    public function definition(): array
    {
        return [
            'id_pelanggan' => Pelanggan::inRandomOrder()->first()->id,
            'jenis_kerusakan' => $this->faker->word(),
            'tanggal_masuk' => $this->faker->date(),
            'catatan' => $this->faker->sentence(),
            'harga' => $this->faker->numberBetween(100000, 1000000),
        ];
    }
}
