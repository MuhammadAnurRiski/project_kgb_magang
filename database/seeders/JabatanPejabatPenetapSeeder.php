<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanPejabatPenetapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan_pejabat_penetap')->insert([
           ['id_jabatan_pejabat_penetap' => 1, 'nama_jabatan_pejabat_penetap' => 'Kepala Kantor Wilayah'],
        ]);
    }
}
