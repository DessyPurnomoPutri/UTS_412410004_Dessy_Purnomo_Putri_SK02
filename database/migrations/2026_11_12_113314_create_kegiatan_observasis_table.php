
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_observasi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lokasi_id')
                  ->constrained('lokasi_observasi')
                  ->cascadeOnDelete();

            $table->string('kode_kegiatan')->unique();
            $table->string('nama_kegiatan');
            $table->date('tanggal_observasi');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('target_pengamatan');
            $table->enum('status', [
                'direncanakan',
                'berlangsung',
                'selesai',
                'dibatalkan'
            ])->default('direncanakan');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_observasi');
    }
};
