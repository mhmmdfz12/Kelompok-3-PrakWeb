<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\Vitamin;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class VitaminSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $balitas = Balita::all();

        // Vitamin A diberikan 2x setahun untuk anak 6-59 bulan
        foreach ($balitas as $balita) {
            $umurBulan = Carbon::parse($balita->tgl_lahir)->diffInMonths(now());

            // Vitamin A diberikan mulai umur 6 bulan
            if ($umurBulan >= 6) {
                $jumlahPemberian = floor($umurBulan / 6); // Setiap 6 bulan

                for ($i = 0; $i < min($jumlahPemberian, 8); $i++) {
                    $tanggal = Carbon::parse($balita->tgl_lahir)
                        ->addMonths(6 + ($i * 6))
                        ->addDays($faker->numberBetween(-5, 5));

                    // Skip jika tanggal di masa depan
                    if ($tanggal->isFuture()) {
                        continue;
                    }

                    // Tentukan jenis vitamin berdasarkan bulan pemberian
                    $bulanPemberian = $tanggal->month;
                    $jenisVitamin = in_array($bulanPemberian, [2, 3, 8, 9]) ? 'Vitamin A' : 'Vitamin A';

                    Vitamin::create([
                        'balita_id' => $balita->id,
                        'jenis_vitamin' => $jenisVitamin,
                        'tanggal' => $tanggal->format('Y-m-d'),
                        'keterangan' => $faker->randomElement([
                            'Kapsul merah',
                            'Kapsul biru',
                            'Normal',
                            null,
                        ]),
                    ]);
                }
            }

            // Beberapa balita juga dapat vitamin C atau multivitamin (opsional)
            if ($faker->boolean(30) && $umurBulan >= 12) {
                Vitamin::create([
                    'balita_id' => $balita->id,
                    'jenis_vitamin' => $faker->randomElement(['Vitamin C', 'Multivitamin']),
                    'tanggal' => Carbon::parse($balita->tgl_lahir)
                        ->addMonths($faker->numberBetween(12, $umurBulan))
                        ->format('Y-m-d'),
                    'keterangan' => 'Tambahan suplemen',
                ]);
            }
        }
    }
}
