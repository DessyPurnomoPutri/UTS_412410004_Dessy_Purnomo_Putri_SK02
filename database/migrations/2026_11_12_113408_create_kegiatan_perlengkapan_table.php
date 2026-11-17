
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_perlengkapan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kegiatan_id')
                  ->constrained('kegiatan_observasi')
                  ->cascadeOnDelete();

            $table->foreignId('perlengkapan_id')
                  ->constrained('perlengkapan')
                  ->cascadeOnDelete();

            $table->unsignedInteger('jumlah_digunakan')->default(1);
            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->unique(['kegiatan_id', 'perlengkapan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_perlengkapan');
    }
};
