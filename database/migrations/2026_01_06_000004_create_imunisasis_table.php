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
        Schema::create('imunisasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balita_id')->constrained('balitas')->onDelete('cascade');
            $table->string('jenis_imunisasi'); // BCG, Polio, DPT, Campak, Hepatitis B, dll
            $table->date('tanggal');
            $table->string('tempat')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imunisasis');
    }
};
