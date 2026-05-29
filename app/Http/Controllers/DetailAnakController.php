<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengukuranRequest;
use App\Http\Requests\UpdatePengukuranRequest;
use App\Models\Anak;

class DetailAnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman indeks detail anak
    public function index(Anak $anak)
    {
        $detailanak = $anak->detailAnaks()
            ->orderBy('bulan')
            ->get();

        return view('detail.index', compact('detailanak', 'anak'));
    }

    // Menampilkan halaman tambah detail anak
    public function create(Anak $anak)
    {
        $latestBulan = $anak->detailAnaks()->max('bulan');
        $bulan = is_null($latestBulan) ? 0 : $latestBulan + 1;

        return view('detail.create', compact('anak', 'bulan'));
    }

    // Menyimpan data detail anak baru
    public function store(StorePengukuranRequest $request, Anak $anak)
    {
        $latestBulan = $anak->detailAnaks()->max('bulan');
        $bulan = is_null($latestBulan) ? 0 : $latestBulan + 1;

        $anak->detailAnaks()->create([
            'bulan' => $bulan,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
        ]);

        return redirect()->route('detail.index', ['anak' => $anak]);
    }

    // Menampilkan halaman edit detail anak
    public function edit(Anak $anak, $detail)
    {
        $detailAnak = $anak->detailAnaks()->findOrFail($detail);

        return view('detail.edit', compact('detailAnak', 'anak'));
    }

    public function update(UpdatePengukuranRequest $request, Anak $anak, $detail)
    {
        $detailAnak = $anak->detailAnaks()->findOrFail($detail);
        $detailAnak->berat = $request->berat;
        $detailAnak->tinggi = $request->tinggi;
        $detailAnak->save();

        return redirect()->route('detail.index', ['anak' => $anak]);
    }

    // Menampilkan halaman hasil
    public function hasil(Anak $anak)
    {
        return view('detail.hasil', compact('anak'));
    }
}
