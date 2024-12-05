<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalFactory extends Factory
{
    protected $model = \App\Models\Jadwal::class;

    public function definition()
    {
        return [
            'nama_kegiatan' => $this->faker->sentence(3),
            'tanggal' => $this->faker->date(),
            'waktu' => $this->faker->time(),
        ];
    }
}
