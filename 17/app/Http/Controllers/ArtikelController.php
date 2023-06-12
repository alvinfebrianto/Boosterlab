<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArtikelController extends Controller
{
    /**
     * Membuat instance controller baru
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan halaman index artikel dengan daftar artikel
     *
     * @return void
     */
    public function index()
    {
        $artikels = Artikel::latest()->paginate(10);
        return view('artikel.index', compact('artikels'));
    }

    /**
    * Menampilkan halaman tambah artikel
    *
    * @return void
    */
    public function create()
    {
        return view('artikel.create');
    }


    /**
    * Menyimpan data artikel baru
    *
    * @param  mixed $request
    * @return void
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:png,jpg,jpeg,webp|max:4096',
            'title'     => 'required',
            'content'   => 'required'
        ]);

        // Upload gambar
        $image = $request->file('image');
        $image->storeAs('public/artikels', $image->hashName());

        $artikel = Artikel::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        if($artikel){
            // Redirect dengan pesan sukses
            return redirect()->route('artikel.index')->with(['success' => 'Artikel Berhasil Disimpan!']);
        }else{
            // Redirect dengan pesan error
            return redirect()->route('artikel.index')->with(['error' => 'Artikel Gagal Disimpan!']);
        }
    }

    /**
     * Menampilkan halaman detail artikel
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel.show', compact('artikel'));
    }

    /**
    * Menampilkan halaman edit artikel
    *
    * @param  mixed $artikel
    * @return void
    */
    public function edit(Artikel $artikel)
    {
        return view('artikel.edit', compact('artikel'));
    }

    /**
    * Memperbarui data artikel yang ada
    *
    * @param  mixed $request
    * @param  mixed $artikel
    * @return void
    */
    public function update(Request $request, Artikel $artikel)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required'
        ]);

        // Mendapatkan data artikel melalui ID
        $artikel = Artikel::findOrFail($artikel->id);

        if($request->file('image') == "") {

            $artikel->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);

        } else {

            // Hapus gambar lama
            Storage::disk('local')->delete('public/artikels/'.$artikel->image);

            // Upload gambar baru
            $image = $request->file('image');
            $image->storeAs('public/artikels', $image->hashName());

            $artikel->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);

        }

        if($artikel){
            // Redirect dengan pesan sukses
            return redirect()->route('artikel.index')->with(['success' => 'Artikel Berhasil Diperbarui!']);
        }else{
            // Redirect dengan pesan error
            return redirect()->route('artikel.index')->with(['error' => 'Artikel Gagal Diperbarui!']);
        }
    }

    /**
    * Menghapus data artikel
    *
    * @param  mixed $id
    * @return void
    */
    public function destroy($id)
    {
    $artikel = Artikel::findOrFail($id);
    Storage::disk('local')->delete('public/artikels/'.$artikel->image);
    $artikel->delete();

    if($artikel){
        // Redirect dengan pesan sukses
        return redirect()->route('artikel.index')->with(['success' => 'Artikel Berhasil Dihapus!']);
    }else{
        // Redirect dengan pesan error
        return redirect()->route('artikel.index')->with(['error' => 'Artikel Gagal Dihapus!']);
    }
    }
}