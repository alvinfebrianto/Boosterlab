<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengukuranRequest;
use App\Http\Requests\UpdatePengukuranRequest;
use App\Models\Anak;
use App\Services\PertumbuhanAnak;

class PengukuranController extends Controller
{
    public function __construct(
        private PertumbuhanAnak $pertumbuhanAnak,
    ) {
        $this->middleware('auth');
    }

    public function index(Anak $anak)
    {
        $pengukuran = $this->pertumbuhanAnak->growthHistory($anak);

        return view('pengukuran.index', compact('pengukuran', 'anak'));
    }

    public function create(Anak $anak)
    {
        $latestBulan = $anak->pengukurans()->max('bulan');
        $bulan = is_null($latestBulan) ? 0 : $latestBulan + 1;

        return view('pengukuran.create', compact('anak', 'bulan'));
    }

    public function store(StorePengukuranRequest $request, Anak $anak)
    {
        $this->pertumbuhanAnak->recordGrowth($anak, $request->validated());

        return redirect()->route('pengukuran.index', ['anak' => $anak]);
    }

    public function edit(Anak $anak, $detail)
    {
        $pengukuran = $anak->pengukurans()->findOrFail($detail);

        return view('pengukuran.edit', compact('pengukuran', 'anak'));
    }

    public function update(UpdatePengukuranRequest $request, Anak $anak, $detail)
    {
        $this->pertumbuhanAnak->updateMeasurement($detail, $request->validated());

        return redirect()->route('pengukuran.index', ['anak' => $anak]);
    }

    public function destroy(Anak $anak, $detail)
    {
        $this->pertumbuhanAnak->removeMeasurement($detail);

        return redirect()->route('pengukuran.index', ['anak' => $anak]);
    }

    public function hasil(Anak $anak)
    {
        return view('pengukuran.hasil', compact('anak'));
    }
}
