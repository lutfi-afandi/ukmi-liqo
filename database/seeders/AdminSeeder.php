<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'username'  => 'admin',
                    'name'  => 'admin',
                    'email' => 'admin@gmail.com',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'admin',
                ],
                [
                    'username'  => 'lpm',
                    'name'  => 'LPM Teknokrat',
                    'email' => 'lpm@gmail.com',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'lpm',
                ],
                [
                    'username'  => 'test',
                    'name'  => 'Test Divisi Teknokrat',
                    'email' => 'test@gmail.com',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'divisi',
                ],
                [
                    'username'  => 'coba',
                    'name'  => 'Percobaan Divisi Teknokrat',
                    'email' => 'coba@gmail.com',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'divisi',
                ],
            ]
        );
        DB::table('kategoris')->insert(
            [
                ['nama_kategori'  => 'Standar Tata Kelola'],
                ['nama_kategori'  => 'Standar Pendidikan'],
                ['nama_kategori'  => 'Standar Penelitian'],
                ['nama_kategori'  => 'Standar Pengabdian Masyarakat'],
                ['nama_kategori'  => 'Standar Kerjasama'],
            ]
        );

        DB::table('periodes')->insert([
            ['tahun' => 2019, 'status' => 0],
            ['tahun' => 2020, 'status' => 0],
            ['tahun' => 2021, 'status' => 0],
            ['tahun' => 2022, 'status' => 0],
            ['tahun' => 2023, 'status' => 0],
            ['tahun' => 2024, 'status' => 1],
        ]);
    }
}
