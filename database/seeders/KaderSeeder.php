<?php

namespace Database\Seeders;

use App\Models\Kader;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KaderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $jabatan = ['Ketua', 'Sekretaris', 'Bendahara', 'Anggota'];

        // Ketua
        Kader::create([
            'nama_kader' => $faker->name('female'),
            'nik' => $faker->numerify('################'),
            'no_hp' => $faker->numerify('08##########'),
            'alamat' => $faker->address(),
            'jabatan' => 'Ketua',
            'tgl_bergabung' => $faker->dateTimeBetween('-5 years', '-1 year')->format('Y-m-d'),
            'status' => 'Aktif',
        ]);

        // Sekretaris
        Kader::create([
            'nama_kader' => $faker->name('female'),
            'nik' => $faker->numerify('################'),
            'no_hp' => $faker->numerify('08##########'),
            'alamat' => $faker->address(),
            'jabatan' => 'Sekretaris',
            'tgl_bergabung' => $faker->dateTimeBetween('-5 years', '-1 year')->format('Y-m-d'),
            'status' => 'Aktif',
        ]);

        // Bendahara
        Kader::create([
            'nama_kader' => $faker->name('female'),
            'nik' => $faker->numerify('################'),
            'no_hp' => $faker->numerify('08##########'),
            'alamat' => $faker->address(),
            'jabatan' => 'Bendahara',
            'tgl_bergabung' => $faker->dateTimeBetween('-5 years', '-1 year')->format('Y-m-d'),
            'status' => 'Aktif',
        ]);

        // Anggota (5-7 orang)
        for ($i = 0; $i < rand(5, 7); $i++) {
            Kader::create([
                'nama_kader' => $faker->name('female'),
                'nik' => $faker->numerify('################'),
                'no_hp' => $faker->numerify('08##########'),
                'alamat' => $faker->address(),
                'jabatan' => 'Anggota',
                'tgl_bergabung' => $faker->dateTimeBetween('-5 years', '-1 year')->format('Y-m-d'),
                'status' => $faker->randomElement(['Aktif', 'Aktif', 'Aktif', 'Tidak Aktif']), // 75% aktif
            ]);
        }
    }
}
