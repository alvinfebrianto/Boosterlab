<?php

namespace App\Services;

use App\Models\Anak;
use App\Models\Pengukuran;
use Illuminate\Database\Eloquent\Collection;

class PertumbuhanAnak
{
    public function registerChild(array $data): Anak
    {
        return Anak::create($data);
    }

    public function recordGrowth(Anak $anak, array $data): Pengukuran
    {
        $latestBulan = $anak->pengukurans()->max('bulan');
        $bulan = is_null($latestBulan) ? 0 : $latestBulan + 1;

        return $anak->pengukurans()->create([
            'bulan' => $bulan,
            'berat' => $data['berat'],
            'tinggi' => $data['tinggi'],
        ]);
    }

    public function growthHistory(Anak $anak): Collection
    {
        return $anak->pengukurans()
            ->orderBy('bulan')
            ->get();
    }

    public function updateChild(string $nomor, array $data): bool
    {
        $anak = Anak::findOrFail($nomor);
        return $anak->update($data);
    }

    public function updateMeasurement(int $id, array $data): bool
    {
        $pengukuran = Pengukuran::findOrFail($id);
        return $pengukuran->update($data);
    }

    public function removeChild(string $nomor): bool
    {
        $anak = Anak::findOrFail($nomor);
        return (bool) $anak->delete();
    }

    public function removeMeasurement(int $id): bool
    {
        $pengukuran = Pengukuran::findOrFail($id);
        return (bool) $pengukuran->delete();
    }
}
