<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    // /**
    // * store
    // *
    // * @param  mixed $request
    // * @return void
    // */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'image'     => 'required|image|mimes:png,jpg,jpeg,webp|max:4096',
    //         'title'     => 'required',
    //         'content'   => 'required'
    //     ]);

    //     //upload image
    //     $image = $request->file('image');
    //     $image->storeAs('public/artikels', $image->hashName());

    //     $artikel = Artikel::create([
    //         'image'     => $image->hashName(),
    //         'title'     => $request->title,
    //         'content'   => $request->content
    //     ]);

    //     if($artikel){
    //         //redirect dengan pesan sukses
    //         return redirect()->route('artikel.index')->with(['success' => 'Artikel Berhasil Disimpan!']);
    //     }else{
    //         //redirect dengan pesan error
    //         return redirect()->route('artikel.index')->with(['error' => 'Artikel Gagal Disimpan!']);
    //     }
    // }
}
