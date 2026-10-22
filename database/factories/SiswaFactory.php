<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Siswa>
 */
class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition(): array
    {

        $faker = \Faker\Factory::create('id_ID');

        return [
            'nisn' => $faker->unique()->numerify('##########'),
            'nama' => $faker->name(),
            'jenis_kelamin' => $faker->randomElement(['L', 'P']),
            'jurusan' => $faker->randomElement(['RPL', 'TKJ', 'MM', 'AKL', 'OKTP']),
            'alamat' => $faker->address(),
            'email' => $faker->unique()->safeEmail(),
            'nomor_telepon' => '08'.$this->faker->numerify('##########'),
            'tempat_lahir' => $faker->city(),
            'tanggal_lahir' => $faker->date('Y-m-d', '2008-12-31'),
        ];
    }
}
