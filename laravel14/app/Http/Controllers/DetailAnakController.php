<?php
namespace App\Http\Controllers;
use App\Models\DetailAnak;
use Illuminate\Http\Request;
use Illuminate\View\View;
class DetailAnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $detailanak = DetailAnak::latest()->get();
        return view('detail.index', compact('detailanak'));
    }
    public function create()
    {
        return view('detail.create');
    }
}