<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('detail_anaks', 'pengukurans');
    }

    public function down(): void
    {
        Schema::rename('pengukurans', 'detail_anaks');
    }
};
