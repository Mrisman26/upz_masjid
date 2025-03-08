<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RtRwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['rw' => '008', 'rt' => '024'],
            ['rw' => '008', 'rt' => '025'],
            ['rw' => '008', 'rt' => '026'],
            ['rw' => '010', 'rt' => '031'],
            ['rw' => '010', 'rt' => '032'],
            ['rw' => '010', 'rt' => '033'],
            ['rw' => '001', 'rt' => '001'],
        ];

        DB::table('rt_rws')->insert($data);
    }
}
