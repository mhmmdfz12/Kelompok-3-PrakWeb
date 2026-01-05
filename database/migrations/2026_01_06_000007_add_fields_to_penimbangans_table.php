<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penimbangans', function (Blueprint $table) {
            $table->decimal('lingkar_kepala', 5, 2)->nullable()->after('tinggi_badan');
            $table->enum('status_gizi', ['Gizi Buruk', 'Gizi Kurang', 'Gizi Baik', 'Gizi Lebih', 'Obesitas'])->nullable()->after('lingkar_kepala');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penimbangans', function (Blueprint $table) {
            $table->dropColumn(['lingkar_kepala', 'status_gizi']);
        });
    }
};
