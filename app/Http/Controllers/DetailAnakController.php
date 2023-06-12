<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\DetailAnak;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DetailAnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman indeks detail anak
    public function index($anak)
    {
        $detailanak = DetailAnak::latest()->get();
        return view('detail.index', compact('detailanak', 'anak'));
    }

    // Menampilkan halaman tambah detail anak
    public function create($anak)
    {
        $latestDetail = DetailAnak::latest('bulan')->first();
        $bulan = 0;
        if ($latestDetail) {
            $bulan = $latestDetail->bulan + 1;
        }
        return view('detail.create', compact('anak', 'bulan'));
    }

    // Menyimpan data detail anak baru
    public function store(Request $request, $anak)
    {
        $this->validate($request, [
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
        ]);
        $latestDetail = DetailAnak::latest('bulan')->first();
        $bulan = 0;
        if ($latestDetail) {
            $bulan = $latestDetail->bulan + 1;
        }
        $detailAnak = DetailAnak::create([
            'bulan' => $bulan,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
        ]);
        return redirect()->route('detail.index', ['anak' => $anak]);
    }

    // Menampilkan halaman edit detail anak
    public function edit($detail)
    {
        $detailAnak = DetailAnak::findOrFail($detail);
        return view('detail.edit', compact('detailAnak'));
    }

    // Memperbarui data detail anak yang ada
    public function update(Request $request, $detail)
    {
        $this->validate($request, [
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
        ]);
        $detailAnak = DetailAnak::findOrFail($detail);
        $detailAnak->berat = $request->berat;
        $detailAnak->tinggi = $request->tinggi;
        $detailAnak->save();
        return redirect()->route('detail.index', ['anak' => $detailAnak->anak]);
    }

    // Menampilkan halaman hasil
    public function hasil($anak)
    {
        $anak = Anak::findOrFail($anak);
        return view('detail.hasil', compact('anak'));
    }
}