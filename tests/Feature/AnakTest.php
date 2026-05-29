<?php

namespace Tests\Feature;

use App\Models\Anak;
use Carbon\Carbon;
use Tests\TestCase;

class AnakTest extends TestCase
{
    public function test_umur_accessor_returns_formatted_age_from_tanggal_lahir()
    {
        Carbon::setTestNow(Carbon::parse('2026-05-29'));

        $anak = new Anak(['tanggal_lahir' => '2024-01-01']);

        $this->assertEquals('2 tahun 4 bulan 28 hari', $anak->umur);
    }
}
