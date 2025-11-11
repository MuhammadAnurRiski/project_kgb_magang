<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PejabatPenetapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pejabat_penetap')->insert([
            ['id_pejabat_penetap' => 1, 'nama_pejabat_penetap' => 'ALEX COSMAS PINEM, S.H., M.Si.']
        ]);

    }
}
