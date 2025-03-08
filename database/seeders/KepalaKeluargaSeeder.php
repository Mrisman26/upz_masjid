<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KepalaKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Ahmad Syafiq', 'rt_rw_id' => 1, 'jumlah_muzaki' => 4, 'jumlah_tanggungan' => 2],
            ['nama' => 'Budi Santoso', 'rt_rw_id' => 2, 'jumlah_muzaki' => 3, 'jumlah_tanggungan' => 1],
            ['nama' => 'Citra Lestari', 'rt_rw_id' => 3, 'jumlah_muzaki' => 5, 'jumlah_tanggungan' => 3],
            ['nama' => 'Dewi Anggraini', 'rt_rw_id' => 4, 'jumlah_muzaki' => 2, 'jumlah_tanggungan' => 1],
            ['nama' => 'Eko Prasetyo', 'rt_rw_id' => 5, 'jumlah_muzaki' => 6, 'jumlah_tanggungan' => 4],
            ['nama' => 'Fadli Rahman', 'rt_rw_id' => 6, 'jumlah_muzaki' => 3, 'jumlah_tanggungan' => 2],
            ['nama' => 'Gita Nurhayati', 'rt_rw_id' => 7, 'jumlah_muzaki' => 4, 'jumlah_tanggungan' => 2],
        ];

        foreach ($data as $row) {
            DB::table('kepala_keluargas')->insert([
                'nama' => $row['nama'],
                'rt_rw_id' => $row['rt_rw_id'],
                'jumlah_muzaki' => $row['jumlah_muzaki'],
                'jumlah_tanggungan' => $row['jumlah_tanggungan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
