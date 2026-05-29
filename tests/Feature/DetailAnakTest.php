<?php

namespace Tests\Feature;

use App\Models\Anak;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DetailAnakTest extends TestCase
{
    use RefreshDatabase;

    public function test_detail_records_are_scoped_to_the_current_anak()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');
        $otherAnak = $this->createAnak('Anak B');

        $anak->detailAnaks()->create([
            'bulan' => 0,
            'berat' => 10,
            'tinggi' => 80,
        ]);
        $otherAnak->detailAnaks()->create([
            'bulan' => 0,
            'berat' => 20,
            'tinggi' => 100,
        ]);

        $response = $this->actingAs($user)->get(route('detail.index', $anak));

        $response->assertOk();
        $response->assertSee('10 Kg');
        $response->assertSee('80 Cm');
        $response->assertDontSee('20 Kg');
        $response->assertDontSee('100 Cm');
    }

    public function test_next_bulan_is_calculated_per_anak()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');
        $otherAnak = $this->createAnak('Anak B');

        $anak->detailAnaks()->create([
            'bulan' => 0,
            'berat' => 10,
            'tinggi' => 80,
        ]);
        $otherAnak->detailAnaks()->create([
            'bulan' => 7,
            'berat' => 20,
            'tinggi' => 100,
        ]);

        $response = $this->actingAs($user)->post(route('detail.store', $anak), [
            'berat' => 11,
            'tinggi' => 81,
            'bulan' => 99,
        ]);

        $response->assertRedirect(route('detail.index', $anak));
        $this->assertDatabaseHas('detail_anaks', [
            'anak_nomor' => $anak->nomor,
            'bulan' => 1,
            'berat' => 11,
            'tinggi' => 81,
        ]);
    }

    public function test_detail_cannot_be_edited_through_another_anak_route()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');
        $otherAnak = $this->createAnak('Anak B');
        $detail = $anak->detailAnaks()->create([
            'bulan' => 0,
            'berat' => 10,
            'tinggi' => 80,
        ]);

        $response = $this->actingAs($user)->get(route('detail.edit', [
            'anak' => $otherAnak,
            'detail' => $detail->id,
        ]));

        $response->assertNotFound();
    }

    private function createAnak(string $nama): Anak
    {
        return Anak::create([
            'nama' => $nama,
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);
    }
}
