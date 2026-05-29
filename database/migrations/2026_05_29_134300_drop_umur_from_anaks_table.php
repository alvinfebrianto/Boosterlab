<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUmurFromAnaksTable extends Migration
{
    public function up()
    {
        Schema::table('anaks', function (Blueprint $table) {
            $table->dropColumn('umur');
        });
    }

    public function down()
    {
        Schema::table('anaks', function (Blueprint $table) {
            $table->string('umur');
        });
    }
}
