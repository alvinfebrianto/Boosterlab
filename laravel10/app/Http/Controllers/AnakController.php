<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnakController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $anaks = Anak::latest()->paginate(10);
        return view('home', compact('anaks'));
    }


    /**
    * create
    *
    * @return void
    */
    public function create()
    {
        return view('anak.create');
    }

    /**
    * store
    *
    * @param  mixed $request
    * @return void
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'gender'        => 'required',
            'tanggal_lahir' => 'required|date',
            'umur'          => 'required|integer',
            'berat_lahir'   => 'required|numeric',
            'tinggi_lahir'  => 'required|numeric',
        ]);

        $anak = Anak::create([
            'nama'          => $request->nama,
            'gender'        => $request->gender,
            'tanggal_lahir' => $request->tanggal_lahir,
            'umur'          => $request->umur,
            'berat_lahir'   => $request->berat_lahir,
            'tinggi_lahir'  => $request->tinggi_lahir,
        ]);

        if ($anak) {
            return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Disimpan!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data Anak Gagal Disimpan!']);
        }
    }

    /**
     * show
     *
     * @param  mixed $nomor
     * @return View
     */
    public function show(string $nomor): View
    {
        $anak = Anak::findOrFail($nomor);
        return view('anak.show', compact('anak'));
    }

    /**
    * edit
    *
    * @param  mixed $anak
    * @return void
    */
    public function edit(Anak $anak)
    {
        return view('anak.edit', compact('anak'));
    }

    /**
    * update
    *
    * @param  mixed $request
    * @param  mixed $artikel
    * @return void
    */
    public function update(Request $request, $nomor)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'gender'        => 'required',
            'tanggal_lahir' => 'required|date',
            'umur'          => 'required|integer',
            'berat_lahir'   => 'required|numeric',
            'tinggi_lahir'  => 'required|numeric',
        ]);

        $anak = Anak::findOrFail($nomor);

        $anak->nama = $request->nama;
        $anak->gender = $request->gender;
        $anak->tanggal_lahir = $request->tanggal_lahir;
        $anak->umur = $request->umur;
        $anak->berat_lahir = $request->berat_lahir;
        $anak->tinggi_lahir = $request->tinggi_lahir;

        if ($anak) {
            return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Diperbarui!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data Anak Gagal Diperbarui!']);
        }
    }

    /**
    * destroy
    *
    * @param  mixed $nomor
    * @return void
    */
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