<?php

namespace App\Http\Controllers;

use App\Models\Mustahik;
use App\Models\RtRw;
use App\Models\Zakat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function muzakiPDF(Request $request)
    {
        $tahun = $request->tahun;
        $tanggal = $request->tanggal; // Format: YYYY-MM-DD

        // Ambil daftar tanggal unik berdasarkan tahun
        $tanggalList = Zakat::whereYear('created_at', $tahun)
            ->selectRaw('DATE(created_at) as tanggal')
            ->distinct()
            ->orderBy('tanggal', 'desc')
            ->pluck('tanggal');

        $query = Zakat::whereYear('created_at', $tahun);

        if ($tanggal) {
            $query->whereDate('created_at', $tanggal);
        }

        $zakats = $query->get();

        // **Kelompokkan data berdasarkan tanggal**
        $groupedZakat = $zakats->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
        });

        $pdf = Pdf::loadView('pdf.muzaki-pdf', compact('groupedZakat', 'tahun', 'tanggalList'))
            ->setPaper('f4', 'landscape');

        return $pdf->stream("zakat-{$tahun}.pdf");
    }

    public function zakatPDF($tahun = null)
    {
        $tahun = $tahun ?? date('Y');

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
            DB::raw('SUM(zakats.zakat_fitrah_uang + zakats.zakat_mal + zakats.zakat_penghasilan + zakats.infaq) as total_jumlah')
        )
        ->join('kepala_keluargas', 'zakats.kepala_keluarga_id', '=', 'kepala_keluargas.id')
        ->join('rt_rws', 'kepala_keluargas.rt_rw_id', '=', 'rt_rws.id')
        ->whereYear('zakats.created_at', $tahun)
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'desc')
        ->get();

        // Load PDF view
        $pdf = Pdf::loadView('pdf.zakat-pdf', compact('rekapitulasi', 'tahun'))->setPaper('f4', 'landscape');

        return $pdf->stream("Rekap-Zakat-$tahun.pdf"); // Bisa juga menggunakan ->download()
    }

    public function mustahikPDF(Request $request)
    {
        $mustahiks = Mustahik::when($request->kriteria, function($query, $kriteria) {
            return $query->where('kriteria', $kriteria);
        })
        ->when($request->tahun, function($query, $tahun) {
            return $query->whereYear('created_at', $tahun);
        })
        ->when($request->rt_rw_id, function($query, $rt_rw_id) {
            return $query->where('rt_rw_id', $rt_rw_id);
        })
        ->with('rtRw')
        ->get();

        // Generate nama file PDF berdasarkan filter yang digunakan
        $filename = 'data_mustahik';

        if ($request->kriteria) {
            $filename .= '_' . $request->kriteria;
        }

        if ($request->tahun) {
            $filename .= '_' . $request->tahun;
        }

        if ($request->rt_rw_id) {
            // Coba ambil data RT/RW untuk mendapatkan deskripsi yang lebih jelas
            $rtRw = RtRw::find($request->rt_rw_id);
            if ($rtRw) {
                $filename .= '_RT_' . $rtRw->rt . '_RW_' . $rtRw->rw;
            } else {
                $filename .= '_' . $request->rt_rw_id;
            }
        }

        // Bersihkan nama file, misalnya mengganti spasi dengan underscore dan huruf kecil
        $filename = strtolower(str_replace(' ', '_', $filename)) . '.pdf';

        // Load view khusus PDF (misalnya resources/views/mustahik/pdf.blade.php)
        $pdf = PDF::loadView('pdf.mustahik-pdf', compact('mustahiks'))->setPaper('f4', 'landscape');

        // Download file PDF dengan nama yang sudah disesuaikan
        return $pdf->download($filename);
    }
}
