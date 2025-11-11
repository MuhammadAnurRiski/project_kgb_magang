<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PangkatGolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('pangkat_golongan')->insert([
            ['id_pangkat_golongan' => 1, 'nama_pangkat_golongan' => 'Juru Muda (I/a)'],
            ['id_pangkat_golongan' => 2, 'nama_pangkat_golongan' => 'Juru Muda Tingkat. I (I/b)'],
            ['id_pangkat_golongan' => 3, 'nama_pangkat_golongan' => 'Juru (I/c)'],
            ['id_pangkat_golongan' => 4, 'nama_pangkat_golongan' => 'Juru Tingkat. I (I/d)'],
            ['id_pangkat_golongan' => 5, 'nama_pangkat_golongan' => 'Pengatur Muda (II/a)'],
            ['id_pangkat_golongan' => 6, 'nama_pangkat_golongan' => 'Pengatur Muda Tingkat. I (II/b)'],
            ['id_pangkat_golongan' => 7, 'nama_pangkat_golongan' => 'Pengatur (II/c)'],
            ['id_pangkat_golongan' => 8, 'nama_pangkat_golongan' => 'Pengatur Tingkat. I (II/d)'],
            ['id_pangkat_golongan' => 9, 'nama_pangkat_golongan' => 'Penata Muda (III/a)'],
            ['id_pangkat_golongan' => 10, 'nama_pangkat_golongan' => 'Penata Muda Tingkat. I (III/b)'],
            ['id_pangkat_golongan' => 11, 'nama_pangkat_golongan' => 'Penata (III/c)'],
            ['id_pangkat_golongan' => 12, 'nama_pangkat_golongan' => 'Penata Tingkat. I (III/d)'],
            ['id_pangkat_golongan' => 13, 'nama_pangkat_golongan' => 'Pembina. (IV/a)'],
            ['id_pangkat_golongan' => 14, 'nama_pangkat_golongan' => 'Pembina Tingkat. I(IV/b)'],
            ['id_pangkat_golongan' => 15, 'nama_pangkat_golongan' => 'Pembina Utama Muda (IV/c)'],
            ['id_pangkat_golongan' => 16, 'nama_pangkat_golongan' => 'Pembina Utama Madya (IV/d)'],
            ['id_pangkat_golongan' => 17, 'nama_pangkat_golongan' => 'Pembina Utama (IV/e)'],
        ]);
    }
}
