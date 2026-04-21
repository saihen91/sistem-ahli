<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Anggota>
 */
class AnggotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_anggota' => 'A' . $this->faker->unique()->numberBetween(1000, 9999),
            'nama' => $this->faker->name(),
            'ic' => $this->faker->unique()->numerify('######-##-####'),
            'no_tel' => $this->faker->phoneNumber,
        ];
    }
}
