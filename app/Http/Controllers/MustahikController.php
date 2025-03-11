<?php

namespace App\Http\Controllers;

use App\Models\Mustahik;
use App\Models\RtRw;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MustahikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $tahun = $request->input('tahun', date('Y')); // Default ke tahun sekarang jika tidak dipilih

        $mustahiks = Mustahik::with('rtRw')
        ->whereYear('created_at', $tahun)
        ->get();

        // Ambil daftar tahun unik dari data mustahik untuk dropdown filter
        $tahunList = Mustahik::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun')->toArray();

        return view('mustahik.index', compact('mustahiks', 'tahun', 'tahunList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rtRws = RtRw::all();
        return view('mustahik.create', compact('rtRws'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kriteria' => 'required|in:Fakir,Miskin,Amil,Mualaf,Gharim,Riqab,Fi Sabilillah,Ibnu Sabil',
            'lainnya' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'rt_rw_id' => 'required|exists:rt_rws,id',
        ]);

        Mustahik::create($request->all());
        return redirect()->route('mustahik.index')->with('success', 'Mustahik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mustahik $mustahik)
    {
        return view('mustahik.show', compact('mustahik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mustahik $mustahik)
    {
        $rtRws = RtRw::all();
        return view('mustahik.edit', compact('mustahik', 'rtRws'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mustahik $mustahik)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kriteria' => 'required|in:Fakir,Miskin,Amil,Mualaf,Gharim,Riqab,Fi Sabilillah,Ibnu Sabil',
            'lainnya' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'rt_rw_id' => 'required|exists:rt_rws,id',
        ]);

        $mustahik->update($request->all());
        return redirect()->route('mustahik.index')->with('success', 'Mustahik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mustahik = Mustahik::findOrFail($id);
        $mustahik->delete();

        return redirect()->route('mustahik.index')->with('success', 'Mustahik berhasil dihapus!');
    }
}
