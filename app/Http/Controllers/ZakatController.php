<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\RtRw;
use App\Models\Zakat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ZakatController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya pengguna yang sudah login dapat mengakses controller ini
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun sekarang jika tidak dipilih

        $zakats = Zakat::with('kepalaKeluarga')
            ->whereYear('created_at', $tahun)
            ->get();

        // Ambil daftar tanggal unik dari zakat berdasarkan tahun
        $tanggalList = Zakat::whereYear('created_at', $tahun)
            ->selectRaw('DATE(created_at) as tanggal')
            ->distinct()
            ->orderBy('tanggal', 'desc')
            ->pluck('tanggal');

        return view('zakat.index', compact('zakats', 'tahun', 'tanggalList'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kepalaKeluargas = KepalaKeluarga::all();
        return view('zakat.create', compact('kepalaKeluargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluargas,id',
            'jenis_zakat_fitrah' => 'required|in:beras,uang',
            'zakat_mal' => 'nullable|numeric',
            'zakat_penghasilan' => 'nullable|numeric',
        ]);

        $kepalaKeluarga = KepalaKeluarga::findOrFail($request->kepala_keluarga_id);
        $jumlahMuzaki = $kepalaKeluarga->jumlah_muzaki;

        $zakat = new Zakat();
        $zakat->kepala_keluarga_id = $kepalaKeluarga->id;
        $zakat->user_id = Auth::id(); // Menyimpan ID petugas yang menginput zakat
        $zakat->zakat_fitrah_beras = ($request->jenis_zakat_fitrah == "beras") ? $jumlahMuzaki * 3.25 : 0;
        $zakat->zakat_fitrah_uang = ($request->jenis_zakat_fitrah == "uang") ? $jumlahMuzaki * 32500 : 0;
        $zakat->zakat_mal = $request->zakat_mal ?? 0;
        $zakat->zakat_penghasilan = $request->zakat_penghasilan ?? 0;
        $zakat->infaq = $jumlahMuzaki * 5000;
        $zakat->save();

        return redirect()->route('zakat.index')->with('success', 'Data Zakat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $zakat = Zakat::with(['kepalaKeluarga.rtRw', 'user'])->findOrFail($id);
        return view('zakat.show', compact('zakat'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $zakat = Zakat::with('kepalaKeluarga.rtRw')->findOrFail($id); // Ambil data zakat & relasi
        $kepalaKeluargas = KepalaKeluarga::with('rtRw')->get(); // Ambil semua kepala keluarga beserta RT/RW
        $rtRws = RtRw::all(); // Ambil semua data RT/RW

        return view('zakat.edit', compact('zakat', 'kepalaKeluargas', 'rtRws'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluargas,id',
            'jumlah_muzaki' => 'required|integer|min:1',
            'bentuk_zakat' => 'required|in:beras,uang',
            'zakat_mal' => 'nullable|numeric',
            'zakat_penghasilan' => 'nullable|numeric',
        ]);

        // Cari data Zakat berdasarkan ID
        $zakat = Zakat::findOrFail($id);

        // Update data Kepala Keluarga (pastikan relasi benar)
        $kepalaKeluarga = KepalaKeluarga::findOrFail($request->kepala_keluarga_id);
        $kepalaKeluarga->jumlah_tanggungan = $request->jumlah_tanggungan;
        $kepalaKeluarga->jumlah_muzaki = $request->jumlah_muzaki;
        $kepalaKeluarga->rt_rw_id = $request->rt_rw_id; // Update RT/RW
        $kepalaKeluarga->save();

        // Update data Zakat
        $zakat->kepala_keluarga_id = $request->kepala_keluarga_id;
        $zakat->zakat_fitrah_beras = ($request->bentuk_zakat == 'beras') ? ($request->jumlah_muzaki * 3.25) : 0;
        $zakat->zakat_fitrah_uang = ($request->bentuk_zakat == 'uang') ? ($request->jumlah_muzaki * 32500) : 0;
        $zakat->zakat_mal = $request->zakat_mal;
        $zakat->zakat_penghasilan = $request->zakat_penghasilan;
        $zakat->save();

        return redirect()->route('zakat.index')->with('success', 'Data Zakat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zakat $zakat)
    {
        $zakat->delete();
        return redirect()->route('zakat.index');
    }

}
