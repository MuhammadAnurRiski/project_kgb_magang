<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pegawai::create([
            'nip' => '196508101990031001',
            'nama_pegawai' => 'John Doe',
            'id_jabatan' => 1,
            'id_pangkat_golongan' => 1,
            'id_masa_kerja_golongan' => 1,
            'id_gaji' => 1,
            'id_pejabatt_penetap' => 1,
            'id_jabatan_pejabat_penetap' => 1,
            'nominal_kgb_terakhir' => 3000000,
            'tmt_pangkat' => '2020-01-01',
            'masa_kerja_bulan' => 0,
            'masa_kerja_tahun' => 1,  
        ]);

    }
}
