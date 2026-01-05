<?php

namespace Database\Seeders;

use App\Models\JadwalPosyandu;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Jadwal masa lalu (3 bulan terakhir - bulanan)
        for ($i = 3; $i >= 1; $i--) {
            $tanggal = Carbon::now()->subMonths($i)->startOfMonth()->addDays(9); // Tanggal 10 setiap bulan
            
            JadwalPosyandu::create([
                'tanggal' => $tanggal->format('Y-m-d'),
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
                'tempat' => $faker->randomElement([
                    'Balai RW 05',
                    'Posyandu Mawar',
                    'Posyandu Melati',
                    'Aula Kelurahan',
                ]),
                'keterangan' => 'Penimbangan rutin bulanan',
                'status' => 'Selesai',
            ]);
        }

        // Jadwal bulan ini
        $tanggalBulanIni = Carbon::now()->startOfMonth()->addDays(9);
        JadwalPosyandu::create([
            'tanggal' => $tanggalBulanIni->format('Y-m-d'),
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'tempat' => 'Balai RW 05',
            'keterangan' => 'Penimbangan dan pemeriksaan kesehatan',
            'status' => 'Dijadwalkan',
        ]);

        // Jadwal bulan depan
        $tanggalBulanDepan = Carbon::now()->addMonth()->startOfMonth()->addDays(9);
        JadwalPosyandu::create([
            'tanggal' => $tanggalBulanDepan->format('Y-m-d'),
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'tempat' => 'Posyandu Mawar',
            'keterangan' => 'Penimbangan dan imunisasi',
            'status' => 'Dijadwalkan',
        ]);

        // Jadwal 2 bulan ke depan
        $tanggal2BulanDepan = Carbon::now()->addMonths(2)->startOfMonth()->addDays(9);
        JadwalPosyandu::create([
            'tanggal' => $tanggal2BulanDepan->format('Y-m-d'),
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'tempat' => 'Balai RW 05',
            'keterangan' => 'Penimbangan rutin',
            'status' => 'Dijadwalkan',
        ]);

        // 1 jadwal khusus (imunisasi massal)
        $tanggalKhusus = Carbon::now()->addWeeks(2);
        JadwalPosyandu::create([
            'tanggal' => $tanggalKhusus->format('Y-m-d'),
            'jam_mulai' => '09:00',
            'jam_selesai' => '14:00',
            'tempat' => 'Puskesmas',
            'keterangan' => 'Imunisasi massal dan vitamin A',
            'status' => 'Dijadwalkan',
        ]);
    }
}
