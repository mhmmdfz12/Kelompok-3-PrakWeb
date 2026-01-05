<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\Imunisasi;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ImunisasiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $balitas = Balita::all();

        // Jadwal imunisasi dasar
        $jadwalImunisasi = [
            ['jenis' => 'BCG', 'bulan' => 1],
            ['jenis' => 'Polio 1', 'bulan' => 1],
            ['jenis' => 'Hepatitis B', 'bulan' => 2],
            ['jenis' => 'DPT 1', 'bulan' => 2],
            ['jenis' => 'Polio 2', 'bulan' => 3],
            ['jenis' => 'DPT 2', 'bulan' => 4],
            ['jenis' => 'Polio 3', 'bulan' => 4],
            ['jenis' => 'DPT 3', 'bulan' => 6],
            ['jenis' => 'Polio 4', 'bulan' => 6],
            ['jenis' => 'Campak', 'bulan' => 9],
        ];

        foreach ($balitas as $balita) {
            $umurBulan = Carbon::parse($balita->tgl_lahir)->diffInMonths(now());

            foreach ($jadwalImunisasi as $jadwal) {
                // Hanya buat imunisasi jika umur balita sudah melewati jadwal
                if ($umurBulan >= $jadwal['bulan']) {
                    // 80% balita lengkap imunisasi, 20% ada yang terlewat
                    if ($faker->boolean(80)) {
                        $tanggal = Carbon::parse($balita->tgl_lahir)
                            ->addMonths($jadwal['bulan'])
                            ->addDays($faker->numberBetween(-7, 7)); // Variasi ±7 hari

                        Imunisasi::create([
                            'balita_id' => $balita->id,
                            'jenis_imunisasi' => $jadwal['jenis'],
                            'tanggal' => $tanggal->format('Y-m-d'),
                            'tempat' => $faker->randomElement([
                                'Posyandu Mawar',
                                'Posyandu Melati',
                                'Puskesmas',
                                'Rumah Sakit',
                            ]),
                            'keterangan' => $faker->randomElement([
                                'Tidak ada efek samping',
                                'Demam ringan',
                                'Baik',
                                null,
                            ]),
                        ]);
                    }
                }
            }
        }
    }
}
