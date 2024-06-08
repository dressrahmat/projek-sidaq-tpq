<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => $this->faker->name,
            'tanggal_lahir' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'provinsi' => $this->faker->state,
            'kabupaten' => $this->faker->city,
            'alamat' => $this->faker->address,
            'amanah' => $this->faker->text,
        ];
    }
}
