<?php

namespace Tests\Feature;

use App\Models\Anak;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DetailAnakTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengukuran_records_are_scoped_to_the_current_anak()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');
        $otherAnak = $this->createAnak('Anak B');

        $anak->pengukurans()->create([
            'bulan' => 0,
            'berat' => 10.5,
            'tinggi' => 80.5,
        ]);
        $otherAnak->pengukurans()->create([
            'bulan' => 0,
            'berat' => 20.5,
            'tinggi' => 100.5,
        ]);

        $response = $this->actingAs($user)->get(route('pengukuran.index', $anak));

        $response->assertOk();
        $response->assertSee('10.5 Kg');
        $response->assertSee('80.5 Cm');
        $response->assertDontSee('20.5 Kg');
        $response->assertDontSee('100.5 Cm');
    }

    public function test_next_bulan_is_calculated_per_anak()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');
        $otherAnak = $this->createAnak('Anak B');

        $anak->pengukurans()->create([
            'bulan' => 0,
            'berat' => 10.5,
            'tinggi' => 80.5,
        ]);
        $otherAnak->pengukurans()->create([
            'bulan' => 7,
            'berat' => 20.5,
            'tinggi' => 100.5,
        ]);

        $response = $this->actingAs($user)->post(route('pengukuran.store', $anak), [
            'berat' => 11,
            'tinggi' => 81,
            'bulan' => 99,
        ]);

        $response->assertRedirect(route('pengukuran.index', $anak));
        $this->assertDatabaseHas('pengukurans', [
            'anak_nomor' => $anak->nomor,
            'bulan' => 1,
            'berat' => 11,
            'tinggi' => 81,
        ]);
    }

    public function test_pengukuran_cannot_be_edited_through_another_anak_route()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');
        $otherAnak = $this->createAnak('Anak B');
        $pengukuran = $anak->pengukurans()->create([
            'bulan' => 0,
            'berat' => 10.5,
            'tinggi' => 80.5,
        ]);

        $response = $this->actingAs($user)->get(route('pengukuran.edit', [
            'anak' => $otherAnak,
            'pengukuran' => $pengukuran->id,
        ]));

        $response->assertNotFound();
    }

    public function test_register_child_creates_birth_measurement_via_http()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('anak.store'), [
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-06-01',
            'berat_lahir' => 3.5,
            'tinggi_lahir' => 51,
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('anaks', [
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-06-01',
        ]);
        $this->assertDatabaseHas('pengukurans', [
            'bulan' => 0,
            'berat' => 3.5,
            'tinggi' => 51,
        ]);
    }

    private function createAnak(string $nama): Anak
    {
        return Anak::create([
            'nama' => $nama,
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
        ]);
    }
}
