<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan')->insert([
            ['id_jabatan' => 1, 'nama_jabatan' => 'Analisis SDM Aparatur Negara'],
            ['id_jabatan' => 2, 'nama_jabatan' => 'Analisis SDM Aparatur Muda'],
            ['id_jabatan' => 3, 'nama_jabatan' => 'Analisis SDM Aparatur Madya'],
            ['id_jabatan' => 4, 'nama_jabatan' => 'Analisis SDM Aparatur Pertama'],
            ['id_jabatan' => 5, 'nama_jabatan' => 'Pengadministrasi Umum'],
        ]);
    }
}
