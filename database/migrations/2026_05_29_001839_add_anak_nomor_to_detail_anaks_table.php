<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAnakNomorToDetailAnaksTable extends Migration
{
    public function up()
    {
        DB::table('detail_anaks')->delete();

        Schema::table('detail_anaks', function (Blueprint $table) {
            $table->foreignId('anak_nomor')
                ->after('id')
                ->constrained('anaks', 'nomor')
                ->cascadeOnDelete();

            $table->unique(['anak_nomor', 'bulan']);
        });
    }

    public function down()
    {
        Schema::table('detail_anaks', function (Blueprint $table) {
            $table->dropUnique(['anak_nomor', 'bulan']);
            $table->dropForeign(['anak_nomor']);
            $table->dropColumn('anak_nomor');
        });
    }
}
