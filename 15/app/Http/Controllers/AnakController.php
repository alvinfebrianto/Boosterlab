<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\View\View;
class AnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $anaks = Anak::latest()->paginate(10);
        return view('home', compact('anaks'));
    }
    public function create()
    {
        return view('anak.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'gender'        => 'required',
            'tanggal_lahir' => 'required|date',
            'berat_lahir'   => 'required|numeric',
            'tinggi_lahir'  => 'required|numeric',
        ]);
        $tanggalLahir = Carbon::parse($request->tanggal_lahir);
        $umur = $tanggalLahir->diff(Carbon::now())->format('%y tahun %m bulan %d hari');
        $anak = Anak::create([
            'nama'          => $request->nama,
            'gender'        => $request->gender,
            'tanggal_lahir' => $tanggalLahir,
            'umur'          => $umur,
            'berat_lahir'   => $request->berat_lahir,
            'tinggi_lahir'  => $request->tinggi_lahir,
        ]);
        if ($anak) {
            return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Disimpan!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data Anak Gagal Disimpan!']);
        }
    }
    public function show(string $nomor): View
    {
        $anak = Anak::findOrFail($nomor);
        return view('anak.show', compact('anak'));
    }
    public function edit(Anak $anak)
    {
        return view('anak.edit', compact('anak'));
    }
    public function update(Request $request, $nomor)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'gender'        => 'required',
            'tanggal_lahir' => 'required|date',
            'berat_lahir'   => 'required|numeric',
            'tinggi_lahir'  => 'required|numeric',
        ]);
        $anakData = $request->only(['nama', 'gender', 'tanggal_lahir', 'berat_lahir', 'tinggi_lahir']);
        $anakData['umur'] = Carbon::parse($request->tanggal_lahir)->diff(Carbon::now())->format('%y tahun %m bulan %d hari');
        $anak = Anak::findOrFail($nomor);
        if ($anak->update($anakData)) {
            return redirect()->route('home')->with(['success' => 'Data Anak Berhasil Diperbarui!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data Anak Gagal Diperbarui!']);
        }
    }
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