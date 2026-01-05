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
        Schema::create('kaders', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kader');
            $table->string('nik', 16)->unique();
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->enum('jabatan', ['Ketua', 'Sekretaris', 'Bendahara', 'Anggota']);
            $table->date('tgl_bergabung')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaders');
    }
};
