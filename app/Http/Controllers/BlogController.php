<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Menampilkan halaman blog dengan daftar artikel
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $artikels = Artikel::latest()->paginate(10);
        return view('blog.index', compact('artikels'));
    }

    /**
     * Menampilkan halaman detail artikel
     *
     * @param  string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id): View
    {
        $artikel = Artikel::findOrFail($id);
        return view('blog.show', compact('artikel'));
    }
}