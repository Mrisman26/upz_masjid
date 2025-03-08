<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\Zakat;
use Illuminate\Http\Request;

class KalkulatorZakatController extends Controller
{
    private $hargaBeras = 32500; // Harga tetap per 2,5 kg

    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');

        $query = Zakat::whereNotNull('zakat_fitrah_uang');

        if ($tanggal) {
            $query->whereDate('created_at', $tanggal);
        }

        $zakats = $query->get();

        foreach ($zakats as $zakat) {
            // Ambil jumlah muzaki dari tabel kepala_keluargas berdasarkan relasi
            $jumlah_muzaki = KepalaKeluarga::where('id', $zakat->kepala_keluarga_id)->value('jumlah_muzaki');

            $zakat->jumlah_muzaki = $jumlah_muzaki;
            $zakat->jumlah_beras = $zakat->zakat_fitrah_uang / $this->hargaBeras * 2.5;
        }

        return view('rekap.kalkulator', compact('zakats', 'tanggal'));
    }
}
