<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnakRequest;
use App\Http\Requests\UpdateAnakRequest;
use App\Models\Anak;
use App\Services\PertumbuhanAnak;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnakController extends Controller
{
    public function __construct(
        private PertumbuhanAnak $pertumbuhanAnak,
    ) {
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
        $this->pertumbuhanAnak->registerChild($request->validated());

        return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Disimpan!']);
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
        $this->pertumbuhanAnak->updateChild($nomor, $request->validated());

        return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Diperbarui!']);
    }

    // Menghapus data anak
    public function destroy($nomor)
    {
        $this->pertumbuhanAnak->removeChild($nomor);

        return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Dihapus!']);
    }
}