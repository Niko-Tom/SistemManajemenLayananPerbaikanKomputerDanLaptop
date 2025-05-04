<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PelangganModel>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->sentence,
            'email' => $this->faker->sentence,
            'telepon' => $this->faker->sentence,
            'keluhan' => $this->faker->paragraphs(3, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
