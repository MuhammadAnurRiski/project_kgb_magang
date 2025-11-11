<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasaKerjaGolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('masa_kerja_golongan')->truncate();

        $masaKerja = [];

        for ($i = 1; $i <= 34; $i++) {
            $masaKerja[] = [
                'masa_kerja_golongan' => $i - 1
            ];
        }

        DB::table('masa_kerja_golongan')->insert($masaKerja);
}
}