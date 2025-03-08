<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kepala_keluarga_id' => 1, 'zakat_fitrah_beras' => 3.25, 'zakat_fitrah_uang' => 0, 'zakat_mal' => 500000, 'zakat_penghasilan' => 200000, 'infaq' => 5000, 'user_id' => 1],
            ['kepala_keluarga_id' => 2, 'zakat_fitrah_beras' => 0, 'zakat_fitrah_uang' => 32000, 'zakat_mal' => null, 'zakat_penghasilan' => 150000, 'infaq' => 10000, 'user_id' => 1],
            ['kepala_keluarga_id' => 3, 'zakat_fitrah_beras' => 3.25, 'zakat_fitrah_uang' => 0, 'zakat_mal' => 750000, 'zakat_penghasilan' => null, 'infaq' => 7000, 'user_id' => 1],
            ['kepala_keluarga_id' => 4, 'zakat_fitrah_beras' => 0, 'zakat_fitrah_uang' => 64000, 'zakat_mal' => null, 'zakat_penghasilan' => 300000, 'infaq' => 12000, 'user_id' => 1],
            ['kepala_keluarga_id' => 5, 'zakat_fitrah_beras' => 3.25, 'zakat_fitrah_uang' => 0, 'zakat_mal' => 1000000, 'zakat_penghasilan' => 500000, 'infaq' => 15000, 'user_id' => 1],
            ['kepala_keluarga_id' => 6, 'zakat_fitrah_beras' => 3.25, 'zakat_fitrah_uang' => 0, 'zakat_mal' => 1000000, 'zakat_penghasilan' => 500000, 'infaq' => 15000, 'user_id' => 1],
            ['kepala_keluarga_id' => 7, 'zakat_fitrah_beras' => 3.25, 'zakat_fitrah_uang' => 0, 'zakat_mal' => 1000000, 'zakat_penghasilan' => 500000, 'infaq' => 15000, 'user_id' => 1],
        ];

        foreach ($data as $row) {
            DB::table('zakats')->insert([
                'kepala_keluarga_id' => $row['kepala_keluarga_id'],
                'zakat_fitrah_beras' => $row['zakat_fitrah_beras'],
                'zakat_fitrah_uang' => $row['zakat_fitrah_uang'],
                'zakat_mal' => $row['zakat_mal'],
                'zakat_penghasilan' => $row['zakat_penghasilan'],
                'infaq' => $row['infaq'],
                'user_id' => $row['user_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
