<?php

namespace Database\Seeders;

use App\Models\Ibu;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class IbuSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Faker Indonesia

        for ($i = 0; $i < 15; $i++) {
            Ibu::create([
                'nama_ibu' => $faker->name('female'),
                'nik' => $faker->numerify('################'), // 16 digit
                'alamat' => $faker->address(),
                'no_hp' => $faker->numerify('08##########'), // Format HP Indonesia
                'tgl_lahir' => $faker->dateTimeBetween('-45 years', '-20 years')->format('Y-m-d'),
            ]);
        }
    }
}
