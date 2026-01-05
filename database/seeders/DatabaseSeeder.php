<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan penting: Master data dulu, baru transaksi
        $this->call([
            IbuSeeder::class,           // 1. Data Ibu (15 ibu)
            KaderSeeder::class,         // 2. Data Kader (8-10 kader)
            BalitaSeeder::class,        // 3. Data Balita (20-50 balita tergantung jumlah anak per ibu)
            PenimbanganSeeder::class,   // 4. Riwayat Penimbangan (multiple per balita)
            ImunisasiSeeder::class,     // 5. Riwayat Imunisasi (sesuai jadwal imunisasi)
            VitaminSeeder::class,       // 6. Riwayat Vitamin (Vitamin A 2x/tahun)
            JadwalSeeder::class,        // 7. Jadwal Posyandu (riwayat + yang akan datang)
        ]);

        $this->command->info('✅ Seeding completed successfully!');
        $this->command->info('📊 Data telah dipopulate dengan nama dan alamat Indonesia.');
    }
}
