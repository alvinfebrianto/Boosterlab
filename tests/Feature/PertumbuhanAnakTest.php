<?php

namespace Tests\Feature;

use App\Models\Anak;
use App\Services\PertumbuhanAnak;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PertumbuhanAnakTest extends TestCase
{
    use RefreshDatabase;

    private PertumbuhanAnak $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PertumbuhanAnak();
    }

    public function test_register_child_creates_anak_with_correct_data()
    {
        $data = [
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ];

        $anak = $this->service->registerChild($data);

        $this->assertInstanceOf(Anak::class, $anak);
        $this->assertEquals('Anak A', $anak->nama);
        $this->assertEquals('Laki-laki', $anak->gender);
        $this->assertEquals('2024-01-01', $anak->tanggal_lahir);
        $this->assertEquals(3.2, $anak->berat_lahir);
        $this->assertEquals(50, $anak->tinggi_lahir);
        $this->assertDatabaseHas('anaks', [
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);
    }

    public function test_record_growth_sets_bulan_0_on_first_measurement()
    {
        $anak = $this->service->registerChild([
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);

        $pengukuran = $this->service->recordGrowth($anak, [
            'berat' => 5.0,
            'tinggi' => 60,
        ]);

        $this->assertEquals(0, $pengukuran->bulan);
        $this->assertEquals(5.0, $pengukuran->berat);
        $this->assertEquals(60, $pengukuran->tinggi);
        $this->assertEquals($anak->nomor, $pengukuran->anak_nomor);
        $this->assertDatabaseHas('pengukurans', [
            'anak_nomor' => $anak->nomor,
            'bulan' => 0,
            'berat' => 5.0,
            'tinggi' => 60,
        ]);
    }

    public function test_record_growth_increments_bulan_from_existing_records()
    {
        $anak = $this->service->registerChild([
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);

        $this->service->recordGrowth($anak, ['berat' => 5.0, 'tinggi' => 60]);
        $second = $this->service->recordGrowth($anak, ['berat' => 6.0, 'tinggi' => 65]);
        $third = $this->service->recordGrowth($anak, ['berat' => 7.0, 'tinggi' => 70]);

        $this->assertEquals(1, $second->bulan);
        $this->assertEquals(2, $third->bulan);
    }

    public function test_record_growth_is_scoped_per_anak()
    {
        $anakA = $this->service->registerChild([
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);
        $anakB = $this->service->registerChild([
            'nama' => 'Anak B',
            'gender' => 'Perempuan',
            'tanggal_lahir' => '2024-06-01',
            'berat_lahir' => 3.0,
            'tinggi_lahir' => 48,
        ]);

        $this->service->recordGrowth($anakA, ['berat' => 5.0, 'tinggi' => 60]);
        $this->service->recordGrowth($anakB, ['berat' => 4.5, 'tinggi' => 55]);

        $this->assertDatabaseHas('pengukurans', ['anak_nomor' => $anakA->nomor, 'bulan' => 0]);
        $this->assertDatabaseHas('pengukurans', ['anak_nomor' => $anakB->nomor, 'bulan' => 0]);
    }

    public function test_growth_history_returns_ordered_pengukuran()
    {
        $anak = $this->service->registerChild([
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);

        $this->service->recordGrowth($anak, ['berat' => 7.0, 'tinggi' => 70]);
        $this->service->recordGrowth($anak, ['berat' => 5.0, 'tinggi' => 60]);
        $this->service->recordGrowth($anak, ['berat' => 6.0, 'tinggi' => 65]);

        $history = $this->service->growthHistory($anak);

        $this->assertCount(3, $history);
        $this->assertEquals(0, $history[0]->bulan);
        $this->assertEquals(1, $history[1]->bulan);
        $this->assertEquals(2, $history[2]->bulan);
    }

    public function test_growth_history_is_scoped_to_anak()
    {
        $anakA = $this->service->registerChild([
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);
        $anakB = $this->service->registerChild([
            'nama' => 'Anak B',
            'gender' => 'Perempuan',
            'tanggal_lahir' => '2024-06-01',
            'berat_lahir' => 3.0,
            'tinggi_lahir' => 48,
        ]);

        $this->service->recordGrowth($anakA, ['berat' => 5.0, 'tinggi' => 60]);
        $this->service->recordGrowth($anakB, ['berat' => 4.5, 'tinggi' => 55]);

        $historyA = $this->service->growthHistory($anakA);
        $historyB = $this->service->growthHistory($anakB);

        $this->assertCount(1, $historyA);
        $this->assertCount(1, $historyB);
        $this->assertEquals($anakA->nomor, $historyA[0]->anak_nomor);
        $this->assertEquals($anakB->nomor, $historyB[0]->anak_nomor);
    }

    public function test_update_child_persists_changes()
    {
        $anak = $this->service->registerChild([
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);

        $result = $this->service->updateChild($anak->nomor, [
            'nama' => 'Anak A Updated',
            'berat_lahir' => 3.5,
        ]);

        $this->assertTrue($result);
        $this->assertDatabaseHas('anaks', [
            'nomor' => $anak->nomor,
            'nama' => 'Anak A Updated',
            'berat_lahir' => 3.5,
        ]);
    }

    public function test_update_measurement_persists_changes()
    {
        $anak = $this->service->registerChild([
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);
        $pengukuran = $this->service->recordGrowth($anak, ['berat' => 5.0, 'tinggi' => 60]);

        $result = $this->service->updateMeasurement($pengukuran->id, [
            'berat' => 5.5,
            'tinggi' => 62,
        ]);

        $this->assertTrue($result);
        $this->assertDatabaseHas('pengukurans', [
            'id' => $pengukuran->id,
            'berat' => 5.5,
            'tinggi' => 62,
        ]);
    }

    public function test_remove_child_cascade_deletes_pengukuran()
    {
        $anak = $this->service->registerChild([
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);
        $this->service->recordGrowth($anak, ['berat' => 5.0, 'tinggi' => 60]);
        $this->service->recordGrowth($anak, ['berat' => 6.0, 'tinggi' => 65]);

        $result = $this->service->removeChild($anak->nomor);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('anaks', ['nomor' => $anak->nomor]);
        $this->assertDatabaseMissing('pengukurans', ['anak_nomor' => $anak->nomor]);
    }

    public function test_remove_measurement_deletes_only_specified_record()
    {
        $anak = $this->service->registerChild([
            'nama' => 'Anak A',
            'gender' => 'Laki-laki',
            'tanggal_lahir' => '2024-01-01',
            'berat_lahir' => 3.2,
            'tinggi_lahir' => 50,
        ]);
        $first = $this->service->recordGrowth($anak, ['berat' => 5.0, 'tinggi' => 60]);
        $second = $this->service->recordGrowth($anak, ['berat' => 6.0, 'tinggi' => 65]);

        $result = $this->service->removeMeasurement($first->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('pengukurans', ['id' => $first->id]);
        $this->assertDatabaseHas('pengukurans', ['id' => $second->id]);
    }
}
