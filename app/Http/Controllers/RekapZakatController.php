<?php

namespace App\Http\Controllers;

use App\Models\Mustahik;
use App\Models\RtRw;
use App\Models\Zakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapZakatController extends Controller
{
    public function zakat(Request $request)
    {

    // Ambil tahun dari request, default ke tahun saat ini jika tidak ada
    $tahun = $request->tahun ?? date('Y');

    $rekapitulasi = Zakat::select(
    DB::raw('DATE(zakats.created_at) as tanggal'),
    DB::raw('SUM(CASE WHEN rt_rws.rt = 24 THEN 1 ELSE 0 END) as rt_24'),
    DB::raw('SUM(CASE WHEN rt_rws.rt = 25 THEN 1 ELSE 0 END) as rt_25'),
    DB::raw('SUM(CASE WHEN rt_rws.rt = 26 THEN 1 ELSE 0 END) as rt_26'),
    DB::raw('SUM(CASE WHEN rt_rws.rt = 31 THEN 1 ELSE 0 END) as rt_31'),
    DB::raw('SUM(CASE WHEN rt_rws.rt = 32 THEN 1 ELSE 0 END) as rt_32'),
    DB::raw('SUM(CASE WHEN rt_rws.rt = 33 THEN 1 ELSE 0 END) as rt_33'),
    DB::raw('SUM(CASE WHEN rt_rws.rw = 1 THEN 1 ELSE 0 END) as rw_01'),
    DB::raw('SUM(zakats.zakat_fitrah_beras) as total_beras'),
    DB::raw('SUM(zakats.zakat_fitrah_uang) as total_uang'),
    DB::raw('SUM(zakats.zakat_mal) as total_mal'),
    DB::raw('SUM(zakats.zakat_penghasilan) as total_penghasilan'),
    DB::raw('SUM(zakats.infaq) as total_infaq'),
    DB::raw('SUM(zakats.zakat_fitrah_uang + zakats.zakat_mal + zakats.zakat_penghasilan + zakats.infaq) as
    total_jumlah')
    )

    ->join('kepala_keluargas', 'zakats.kepala_keluarga_id', '=', 'kepala_keluargas.id')
    ->join('rt_rws', 'kepala_keluargas.rt_rw_id', '=', 'rt_rws.id')
    ->whereYear('zakats.created_at', $tahun) // Filter berdasarkan tahun
    ->groupBy('tanggal')
    ->orderBy('tanggal', 'desc')
    ->get();

    return view('rekap.zakat', compact('rekapitulasi', 'tahun'));
    }

    public function mustahik (Request $request)
    {

        $query = Mustahik::query();

        // Filter berdasarkan kriteria jika ada
        if ($request->has('kriteria') && $request->kriteria != '') {
            $query->where('kriteria', $request->kriteria);
        }

        // Filter berdasarkan Tahun Created_at
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('created_at', $request->tahun);
        }

        // 🔹 Perbaiki Filter RT/RW (Pastikan `rt_rw_id` Sesuai dengan Database)
        if ($request->has('rt_rw_id') && $request->rt_rw_id != '') {
            $query->where('rt_rw_id', $request->rt_rw_id);
        }

        // Ambil data mustahik dengan relasi ke RT/RW
        $mustahiks = $query->with('rtRw')->paginate(10);
        $rtRws = RtRw::all(); // 🔹 Untuk Dropdown Filter RT/RW

        // Ambil daftar tahun dari mustahiks berdasarkan created_at
        $tahun_list = Mustahik::selectRaw('YEAR(created_at) as tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('rekap.mustahik', compact('mustahiks', 'rtRws', 'tahun_list'));
    }
}
