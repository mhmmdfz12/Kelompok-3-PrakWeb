<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\Penimbangan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PenimbanganSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $balitas = Balita::all();

        foreach ($balitas as $balita) {
            $umurBulan = Carbon::parse($balita->tgl_lahir)->diffInMonths(now());
            
            // Tentukan berapa kali penimbangan (3-8 kali, tergantung umur)
            $jumlahPenimbangan = min(8, max(3, floor($umurBulan / 2)));

            for ($i = 0; $i < $jumlahPenimbangan; $i++) {
                // Tanggal penimbangan bertahap dari lahir
                $bulanKe = floor(($umurBulan / $jumlahPenimbangan) * ($i + 1));
                $tglTimbang = Carbon::parse($balita->tgl_lahir)->addMonths($bulanKe);

                // Berat badan realistis berdasarkan umur
                if ($bulanKe <= 6) {
                    $beratBadan = $balita->berat_badan_lahir + ($bulanKe * 0.7);
                } elseif ($bulanKe <= 12) {
                    $beratBadan = $balita->berat_badan_lahir + 4 + (($bulanKe - 6) * 0.4);
                } elseif ($bulanKe <= 24) {
                    $beratBadan = $balita->berat_badan_lahir + 6 + (($bulanKe - 12) * 0.2);
                } else {
                    $beratBadan = $balita->berat_badan_lahir + 8 + (($bulanKe - 24) * 0.15);
                }

                // Variasi sedikit
                $beratBadan += $faker->randomFloat(2, -0.5, 0.5);

                // Tinggi badan realistis
                $tinggiBadan = 50 + ($bulanKe * 2) + $faker->randomFloat(1, -2, 2);

                // Lingkar kepala
                $lingkarKepala = 35 + ($bulanKe * 0.5) + $faker->randomFloat(1, -1, 1);

                // Auto-calculate status gizi (simplified)
                $beratIdeal = $this->hitungBeratIdeal($bulanKe);
                $persentase = ($beratBadan / $beratIdeal) * 100;
                
                if ($persentase < 70) {
                    $statusGizi = 'Gizi Buruk';
                } elseif ($persentase < 80) {
                    $statusGizi = 'Gizi Kurang';
                } elseif ($persentase <= 120) {
                    $statusGizi = 'Gizi Baik';
                } elseif ($persentase <= 140) {
                    $statusGizi = 'Gizi Lebih';
                } else {
                    $statusGizi = 'Obesitas';
                }

                Penimbangan::create([
                    'balita_id' => $balita->id,
                    'tgl_timbang' => $tglTimbang->format('Y-m-d'),
                    'berat_badan' => round($beratBadan, 2),
                    'tinggi_badan' => round($tinggiBadan, 1),
                    'lingkar_kepala' => round($lingkarKepala, 1),
                    'status_gizi' => $statusGizi,
                    'keterangan' => $faker->randomElement([
                        'Sehat',
                        'Batuk ringan',
                        'Nafsu makan baik',
                        'Aktif',
                        'Normal',
                        null,
                    ]),
                ]);
            }
        }
    }

    private function hitungBeratIdeal($umurBulan)
    {
        if ($umurBulan <= 6) {
            return 3 + ($umurBulan * 0.8);
        } elseif ($umurBulan <= 12) {
            return 8 + (($umurBulan - 6) * 0.3);
        } elseif ($umurBulan <= 24) {
            return 10 + (($umurBulan - 12) * 0.15);
        } else {
            return 12 + (($umurBulan - 24) * 0.1);
        }
    }
}
