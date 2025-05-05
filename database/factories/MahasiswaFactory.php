<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    protected $model = \App\Models\Mahasiswa::class;

    public function definition(): array
    {
        return [
            'nim' => $this->faker->unique()->numerify('22000####'),
            'nama' => $this->faker->name(),
            'jurusan' => $this->faker->randomElement(['Informatika', 'Sistem Informasi', 'Teknik Elektro']),
            'email' => $this->faker->unique()->safeEmail(),
            'alamat' => $this->faker->address(),
        ];
    }
}