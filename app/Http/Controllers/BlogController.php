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

    public function index()
    {
        $artikels = Artikel::latest()->paginate(10);
        return view('blog.index', compact('artikels'));
    }

    public function show(string $id): View
    {
        $artikel = Artikel::findOrFail($id);
        return view('blog.show', compact('artikel'));
    }
}
