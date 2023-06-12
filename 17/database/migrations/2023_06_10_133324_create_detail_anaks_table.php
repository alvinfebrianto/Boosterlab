<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAnaksTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_anaks', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan');
            $table->decimal('berat', 5, 2);
            $table->decimal('tinggi', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_anaks');
    }
}