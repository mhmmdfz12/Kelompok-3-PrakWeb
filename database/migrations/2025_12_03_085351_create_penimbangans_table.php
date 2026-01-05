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
        Schema::create('penimbangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balita_id')->constrained('balitas')->onDelete('cascade');
            $table->date('tgl_timbang');
            $table->float('berat_badan'); 
            $table->float('tinggi_badan'); 
            $table->string('keterangan')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penimbangans');
    }
};
