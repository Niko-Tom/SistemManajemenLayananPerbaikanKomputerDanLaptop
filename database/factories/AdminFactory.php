<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Admin::class;

    public function definition(): array
    {
        return [
            'nama_admin' => $this->faker->name(),
            'kontak' => $this->faker->phoneNumber(),
            'password' => Hash::make('admin123'),
            'role' => $this->faker->randomElement(['Admin', 'Manager', 'Staff']),
        ];
    }
}
