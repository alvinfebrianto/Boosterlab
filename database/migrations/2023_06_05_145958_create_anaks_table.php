<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnaksTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anaks', function (Blueprint $table) {
            $table->id('nomor');
            $table->string('nama');
            $table->string('gender');
            $table->date('tanggal_lahir');

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
        Schema::dropIfExists('anaks');
    }
}