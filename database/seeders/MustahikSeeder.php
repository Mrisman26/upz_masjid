<?php

namespace Database\Seeders;

use App\Models\Mustahik;
use App\Models\RtRw;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MustahikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rtRw = RtRw::first(); // Pastikan ada data di tabel rt_rws

        Mustahik::create([
            'name' => 'Bapak A',
            'kriteria' => 'Fakir',
            'rt_rw_id' => $rtRw->id ?? 1, // Default ke id 1 jika tidak ada data
            'lainnya' => null,
            'keterangan' => 'Mendapatkan bantuan beras 10 kg'
        ]);

        Mustahik::create([
            'name' => 'Ibu B',
            'kriteria' => 'Miskin',
            'rt_rw_id' => $rtRw->id ?? 1,
            'lainnya' => 'Bantuan tambahan',
            'keterangan' => 'Bantuan tunai Rp 500.000'
        ]);
    }
}
