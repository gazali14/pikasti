<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class JadwalFactory extends Factory
{
    protected $model = \App\Models\Jadwal::class;

    public function definition()
    {
        return [
            'nama_kegiatan' => $this->faker->sentence(3),
            'tanggal' => Carbon::createFromFormat('Y-m-d', $this->faker->date())->toDateString(), 
            'waktu' => $this->faker->time(),
        ];
    }
}
