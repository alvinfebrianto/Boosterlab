<?php

namespace Tests\Feature;

use App\Models\Anak;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommaConversionTest extends TestCase
{
    use RefreshDatabase;

    public function test_converts_comma_to_dot_in_berat_and_tinggi_when_recording_growth()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');

        $response = $this->actingAs($user)->post(route('pengukuran.store', $anak), [
            'berat' => '70,5',
            'tinggi' => '90,5',
        ]);

        $response->assertRedirect(route('pengukuran.index', $anak));
        $this->assertDatabaseHas('pengukurans', [
            'bulan' => 0,
            'berat' => 70.5,
            'tinggi' => 90.5,
        ]);
    }

    public function test_converts_comma_to_dot_in_berat_and_tinggi_when_updating_measurement()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');
        $pengukuran = $anak->pengukurans()->create([
            'bulan' => 0,
            'berat' => 3.5,
            'tinggi' => 50,
        ]);

        $response = $this->actingAs($user)->put(route('pengukuran.update', ['anak' => $anak, 'pengukuran' => $pengukuran->id]), [
            'berat' => '70,5',
            'tinggi' => '90,5',
        ]);

        $response->assertRedirect(route('pengukuran.index', $anak));
        $this->assertDatabaseHas('pengukurans', [
            'id' => $pengukuran->id,
            'berat' => 70.5,
            'tinggi' => 90.5,
        ]);
    }

    public function test_converts_comma_to_dot_in_berat_lahir_and_tinggi_lahir_when_registering_child()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('anak.store'), [
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-06-01',
            'berat_lahir' => '3,5',
            'tinggi_lahir' => '51,0',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('pengukurans', [
            'bulan' => 0,
            'berat' => 3.5,
            'tinggi' => 51.0,
        ]);
    }

    public function test_accepts_values_without_comma_with_dot_separator()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');

        $response = $this->actingAs($user)->post(route('pengukuran.store', $anak), [
            'berat' => '70.5',
            'tinggi' => '90.5',
        ]);

        $response->assertRedirect(route('pengukuran.index', $anak));
        $this->assertDatabaseHas('pengukurans', [
            'bulan' => 0,
            'berat' => 70.5,
            'tinggi' => 90.5,
        ]);
    }

    public function test_accepts_values_without_any_separator()
    {
        $user = User::factory()->create();
        $anak = $this->createAnak('Anak A');

        $response = $this->actingAs($user)->post(route('pengukuran.store', $anak), [
            'berat' => '70',
            'tinggi' => '90',
        ]);

        $response->assertRedirect(route('pengukuran.index', $anak));
        $this->assertDatabaseHas('pengukurans', [
            'bulan' => 0,
            'berat' => 70.0,
            'tinggi' => 90.0,
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
