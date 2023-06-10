<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Anak;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $anakList = Anak::all();
        return view('jadwal', compact('anakList'));
    }

    public function adminJadwal()
    {
        $anakList = Anak::all();
        return view('admin.jadwal', compact('anakList'));
    }
}