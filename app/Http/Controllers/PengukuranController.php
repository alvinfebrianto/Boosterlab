<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengukuranRequest;
use App\Http\Requests\UpdatePengukuranRequest;
use App\Models\Anak;

class PengukuranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Anak $anak)
    {
        $pengukuran = $anak->pengukurans()
            ->orderBy('bulan')
            ->get();

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
        $latestBulan = $anak->pengukurans()->max('bulan');
        $bulan = is_null($latestBulan) ? 0 : $latestBulan + 1;

        $anak->pengukurans()->create([
            'bulan' => $bulan,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
        ]);

        return redirect()->route('pengukuran.index', ['anak' => $anak]);
    }

    public function edit(Anak $anak, $detail)
    {
        $pengukuran = $anak->pengukurans()->findOrFail($detail);

        return view('pengukuran.edit', compact('pengukuran', 'anak'));
    }

    public function update(UpdatePengukuranRequest $request, Anak $anak, $detail)
    {
        $pengukuran = $anak->pengukurans()->findOrFail($detail);
        $pengukuran->berat = $request->berat;
        $pengukuran->tinggi = $request->tinggi;
        $pengukuran->save();

        return redirect()->route('pengukuran.index', ['anak' => $anak]);
    }

    public function hasil(Anak $anak)
    {
        return view('pengukuran.hasil', compact('anak'));
    }
}
