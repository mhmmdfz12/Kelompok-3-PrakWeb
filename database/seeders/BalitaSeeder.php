<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\Ibu;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BalitaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $ibus = Ibu::all();

        // Nama balita Indonesia yang umum
        $namaLaki = ['Ahmad', 'Muhammad', 'Rizki', 'Dimas', 'Arif', 'Budi', 'Andi', 'Fajar', 'Rafi', 'Aditya'];
        $namaPerempuan = ['Siti', 'Putri', 'Dewi', 'Ayu', 'Fitri', 'Rani', 'Dinda', 'Sari', 'Lestari', 'Mega'];

        foreach ($ibus as $ibu) {
            // Setiap ibu punya 1-3 anak
            $jumlahAnak = rand(1, 3);
            
            for ($i = 1; $i <= $jumlahAnak; $i++) {
                $jenisKelamin = $faker->randomElement(['L', 'P']);
                $namaBalita = $jenisKelamin == 'L' 
                    ? $faker->randomElement($namaLaki) . ' ' . $faker->firstName('male')
                    : $faker->randomElement($namaPerempuan) . ' ' . $faker->firstName('female');

                // Umur 0-5 tahun
                $tglLahir = $faker->dateTimeBetween('-5 years', '-2 months')->format('Y-m-d');

                Balita::create([
                    'ibu_id' => $ibu->id,
                    'nama_balita' => $namaBalita,
                    'nama_ibu' => $ibu->nama_ibu,
                    'jenis_kelamin' => $jenisKelamin,
                    'tgl_lahir' => $tglLahir,
                    'berat_badan_lahir' => $faker->randomFloat(2, 2.5, 4.5), // 2.5 - 4.5 kg
                    'anak_ke' => $i,
                    'golongan_darah' => $faker->randomElement(['A', 'B', 'AB', 'O', '-']),
                ]);
            }
        }

        // Beberapa balita tanpa ibu_id (legacy data)
        for ($i = 0; $i < 5; $i++) {
            $jenisKelamin = $faker->randomElement(['L', 'P']);
            $namaBalita = $jenisKelamin == 'L' 
                ? $faker->randomElement($namaLaki) . ' ' . $faker->firstName('male')
                : $faker->randomElement($namaPerempuan) . ' ' . $faker->firstName('female');

            Balita::create([
                'ibu_id' => null,
                'nama_balita' => $namaBalita,
                'nama_ibu' => $faker->name('female'),
                'jenis_kelamin' => $jenisKelamin,
                'tgl_lahir' => $faker->dateTimeBetween('-5 years', '-2 months')->format('Y-m-d'),
                'berat_badan_lahir' => $faker->randomFloat(2, 2.5, 4.5),
                'anak_ke' => rand(1, 3),
                'golongan_darah' => $faker->randomElement(['A', 'B', 'AB', 'O', '-']),
            ]);
        }
    }
}
