<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusans')->insert([
            ['kode' => 'Sasing', 'nama' => 'Sastra Inggris'],
            ['kode' => 'PMat', 'nama' => 'Pendidikan Matematika'],
            ['kode' => 'PBI', 'nama' => 'Pendidikan Bahasa Inggris'],
            ['kode' => 'PO', 'nama' => 'Pendidikan Olahraga'],
            ['kode' => 'SIA', 'nama' => 'Sistem Informasi Akuntansi'],
            ['kode' => 'SI', 'nama' => 'Sistem Informasi'],
            ['kode' => 'IF', 'nama' => 'Informatika'],
            ['kode' => 'TI', 'nama' => 'Teknologi Informasi'],
            ['kode' => 'TE', 'nama' => 'Teknik Elektro'],
            ['kode' => 'TK', 'nama' => 'Teknik Komputer'],
            ['kode' => 'TS', 'nama' => 'Teknik Sipil'],
            ['kode' => 'MNJ', 'nama' => 'Manajemen'],
            ['kode' => 'AKT', 'nama' => 'Akuntansi'],
        ]);
    }
}
