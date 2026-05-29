<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnakRequest;
use App\Http\Requests\UpdateAnakRequest;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman index anak dengan daftar data anak
    public function index(Request $request)
    {
        $allowedSorts = ['nomor', 'nama', 'gender', 'tanggal_lahir'];
        $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'created_at';
        $sortDir = $request->get('sort_dir') === 'asc' ? 'asc' : 'desc';

        $anaks = Anak::orderBy($sortBy, $sortDir)->paginate(10);
        return view('home', compact('anaks', 'sortBy', 'sortDir'));
    }

    // Menampilkan halaman tambah data anak
    public function create()
    {
        return view('anak.create');
    }

    // Menyimpan data anak baru
    public function store(StoreAnakRequest $request)
    {
        $anak = Anak::create([
            'nama'          => $request->nama,
            'gender'        => $request->gender,
            'tanggal_lahir' => $request->tanggal_lahir,
            'berat_lahir'   => $request->berat_lahir,
            'tinggi_lahir'  => $request->tinggi_lahir,
        ]);
        if ($anak) {
            return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Disimpan!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data Anak Gagal Disimpan!']);
        }
    }

    // Menampilkan halaman detail data anak
    public function show(string $nomor): View
    {
        $anak = Anak::findOrFail($nomor);
        return view('anak.show', compact('anak'));
    }

    // Menampilkan halaman edit data anak
    public function edit(Anak $anak)
    {
        return view('anak.edit', compact('anak'));
    }

    // Memperbarui data anak yang ada
    public function update(UpdateAnakRequest $request, $nomor)
    {
        $anakData = $request->only(['nama', 'gender', 'tanggal_lahir', 'berat_lahir', 'tinggi_lahir']);
        $anak = Anak::findOrFail($nomor);
        if ($anak->update($anakData)) {
            return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Diperbarui!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data Anak Gagal Diperbarui!']);
        }
    }

    // Menghapus data anak
    public function destroy($nomor)
    {
        $anak = Anak::findOrFail($nomor);
        $anak->delete();
        if ($anak) {
            return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Dihapus!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data Anak Gagal Dihapus!']);
        }
    }
}