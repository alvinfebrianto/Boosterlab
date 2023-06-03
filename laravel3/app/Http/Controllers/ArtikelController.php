<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArtikelController extends Controller
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
        $artikels = Artikel::latest()->paginate(10);
        return view('artikel.index', compact('artikels'));
    }

    /**
    * create
    *
    * @return void
    */
    public function create()
    {
        return view('artikel.create');
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
            'image'     => 'required|image|mimes:png,jpg,jpeg,webp|max:3072',
            'title'     => 'required',
            'content'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/artikels', $image->hashName());

        $artikel = Artikel::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        if($artikel){
            //redirect dengan pesan sukses
            return redirect()->route('artikel.index')->with(['success' => 'Artikel Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('artikel.index')->with(['error' => 'Artikel Gagal Disimpan!']);
        }
    }

    /**
     * show
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
    * edit
    *
    * @param  mixed $artikel
    * @return void
    */
    public function edit(Artikel $artikel)
    {
        return view('artikel.edit', compact('artikel'));
    }


    /**
    * update
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

        //get data Artikel by ID
        $artikel = Artikel::findOrFail($artikel->id);

        if($request->file('image') == "") {

            $artikel->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);

        } else {

            //hapus old image
            Storage::disk('local')->delete('public/artikels/'.$artikel->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/artikels', $image->hashName());

            $artikel->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);

        }

        if($artikel){
            //redirect dengan pesan sukses
            return redirect()->route('artikel.index')->with(['success' => 'Artikel Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('artikel.index')->with(['error' => 'Artikel Gagal Diupdate!']);
        }
    }

    /**
    * destroy
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
        //redirect dengan pesan sukses
        return redirect()->route('artikel.index')->with(['success' => 'Artikel Berhasil Dihapus!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('artikel.index')->with(['error' => 'Artikel Gagal Dihapus!']);
    }
    }
}
