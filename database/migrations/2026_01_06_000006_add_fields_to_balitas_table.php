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
        Schema::table('balitas', function (Blueprint $table) {
            $table->foreignId('ibu_id')->nullable()->after('id')->constrained('ibus')->onDelete('set null');
            $table->string('anak_ke')->nullable()->after('nama_ibu');
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', '-'])->default('-')->after('berat_badan_lahir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('balitas', function (Blueprint $table) {
            $table->dropForeign(['ibu_id']);
            $table->dropColumn(['ibu_id', 'anak_ke', 'golongan_darah']);
        });
    }
};
