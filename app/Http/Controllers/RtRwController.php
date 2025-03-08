<?php

namespace App\Http\Controllers;

use App\Models\RtRw;
use Illuminate\Http\Request;

class RtRwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rtRws = RtRw::all();
        return view('rt_rw.index', compact('rtRws'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rt_rw.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rw' => 'required',
            'rt' => 'required',
        ]);

        RtRw::create([
            'rw' => $request->rw,
            'rt' => $request->rt,
        ]);

        return redirect()->route('rt-rw.index')->with('success', 'Data RT/RW berhasil disimpan!');
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
    public function edit(string $id)
    {
        $rt_rw = RtRw::findOrFail($id); // Ambil satu data sesuai ID
        return view('rt_rw.edit', compact('rt_rw'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rw' => 'required',
            'rt' => 'required',
        ]);

        $rt_rw = RtRw::findOrFail($id);
        $rt_rw->update([
            'rw' => $request->rw,
            'rt' => $request->rt,
        ]);

        return redirect()->route('rt-rw.index')->with('success', 'Data RT/RW berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rt_rw = RtRw::findOrFail($id);
        $rt_rw->delete();

        return redirect()->route('rt-rw.index')->with('success', 'Data RT/RW berhasil dihapus!');
    }

}
