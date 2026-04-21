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
        Schema::create('bayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->cascadeOnDelete();
            $table->decimal('total', 10, 2);
            $table->tinyInteger('bulan'); // 1-12
            $table->year('tahun');
            $table->date('tarikh_bayar');
            $table->enum('kaedah', ['cash', 'transfer'])->default('cash');
            $table->timestamps();

            // Elak duplicate bayaran bulan sama
            $table->unique(['anggota_id', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayarans');
    }
};
