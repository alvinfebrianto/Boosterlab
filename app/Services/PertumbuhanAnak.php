<?php

namespace App\Services;

use App\Models\Anak;
use App\Models\Pengukuran;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class PertumbuhanAnak
{
    public function registerChild(array $data): Anak
    {
        $beratLahir = $data['berat_lahir'] ?? null;
        $tinggiLahir = $data['tinggi_lahir'] ?? null;

        $anakData = Arr::except($data, ['berat_lahir', 'tinggi_lahir']);
        $anak = Anak::create($anakData);

        $anak->pengukurans()->create([
            'bulan' => 0,
            'berat' => $beratLahir,
            'tinggi' => $tinggiLahir,
        ]);

        return $anak;
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

        if ($pengukuran->bulan === 0) {
            throw new \InvalidArgumentException('Cannot remove birth measurement');
        }

        return (bool) $pengukuran->delete();
    }
}
