<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengukurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_nomor')
                  ->constrained('anaks', 'nomor')
                  ->cascadeOnDelete();
            $table->integer('bulan');
            $table->decimal('berat', 5, 2);
            $table->decimal('tinggi', 5, 2);
            $table->unique(['anak_nomor', 'bulan']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengukurans');
    }
};
