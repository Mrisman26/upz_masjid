<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\Mustahik;
use App\Models\RtRw;
use App\Models\Zakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request) // Tambahkan parameter $request
    {
        $tahun = $request->tahun ?? now()->year; // Default ke tahun sekarang

        // Rekapitulasi Zakat berdasarkan tahun
        $rekapitulasi = Zakat::whereYear('created_at', $tahun) // Tambahkan filter tahun
            ->selectRaw('
                SUM(zakat_penghasilan) as total_penghasilan,
                SUM(zakat_mal) as total_mal,
                SUM(zakat_fitrah_beras) as total_beras,
                SUM(zakat_fitrah_uang) as total_uang,
                SUM(infaq) as total_infaq
            ')->first();

        // Statistik Kepala Keluarga berdasarkan RT/RW
        $kepalaKeluargaStats = KepalaKeluarga::join('rt_rws', 'kepala_keluargas.rt_rw_id', '=', 'rt_rws.id')
            ->leftJoin('zakats', 'kepala_keluargas.id', '=', 'zakats.kepala_keluarga_id') // Join ke zakats
            ->whereYear('zakats.created_at', $tahun) // Filter berdasarkan tahun
            ->selectRaw('CONCAT("RW ", rt_rws.rw, " - RT ", rt_rws.rt) as rt_rw, COUNT(kepala_keluargas.id) as total_kepala_keluarga')
            ->groupBy('rt_rw')
            ->get();

            // dd($rekapitulasi);

            $mustahiks = Mustahik::with('rtRw')
            ->whereYear('created_at', $tahun)
            ->get();

            // Statistik Mustahik berdasarkan Kriteria
            $mustahikStats = Mustahik::whereYear('created_at', $tahun)
            ->selectRaw('kriteria, COUNT(id) as total_mustahik')
            ->groupBy('kriteria')
            ->get();

            // Statistik Mustahik berdasarkan RT/RW
            $mustahikRtRwStats = Mustahik::join('rt_rws', 'mustahiks.rt_rw_id', '=', 'rt_rws.id')
            ->whereYear('mustahiks.created_at', $tahun)
            ->selectRaw('CONCAT("RW ", rt_rws.rw, " - RT ", rt_rws.rt) as rt_rw, COUNT(mustahiks.id) as total_mustahik')
            ->groupBy('rt_rw')
            ->get();


        return view('dashboard', compact('rekapitulasi', 'kepalaKeluargaStats', 'mustahiks',  'mustahikStats', 'mustahikRtRwStats', 'tahun'));
    }
}
