<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\RtRw;
use App\Models\Zakat;
use Illuminate\Http\Request;

class KepalaKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun sekarang jika tidak dipilih

        // Ambil kepala keluarga berdasarkan tahun dari zakats
        $kepalaKeluargas = KepalaKeluarga::whereHas('zakats', function ($query) use ($tahun) {
            $query->whereYear('created_at', $tahun);
        })->get();

        return view('kepala_keluarga.index', compact('kepalaKeluargas', 'tahun'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rtRws = RtRw::all();
        return view('kepala_keluarga.create', compact('rtRws'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        KepalaKeluarga::create($request->all());
        return redirect()->route('zakat.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KepalaKeluarga $kepalaKeluarga)
    {
        $rtRws = RtRw::all();
        return view('kepala_keluarga.edit', compact('kepalaKeluarga', 'rtRws'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'rt_rw_id' => 'required|exists:rt_rws,id',
            'jumlah_muzaki' => 'required|integer|min:1',
            'jumlah_tanggungan' => 'required|integer',
        ]);

        $kepalaKeluarga = KepalaKeluarga::findOrFail($id);
        $kepalaKeluarga->update($request->all());

        // Update zakat jika jumlah muzaki berubah
        $zakat = Zakat::where('kepala_keluarga_id', $kepalaKeluarga->id)->first();
        if ($zakat) {
            $zakat->update([
                'zakat_fitrah_beras' => $request->jumlah_muzaki * 3.25,
                'zakat_fitrah_uang' => $request->jumlah_muzaki * 32000,
                'infaq' => $request->jumlah_muzaki * 5000,
            ]);
        }

        return redirect()->route('kepala-keluarga.index')->with('success', 'Data Kepala Keluarga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KepalaKeluarga $kepalaKeluarga)
    {
        $kepalaKeluarga->delete();
        return redirect()->route('kepala-keluarga.index');
    }
}
