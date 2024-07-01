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
                // [
                //     'username'  => 'test',
                //     'name'  => 'Test Divisi Teknokrat',
                //     'email' => 'test@gmail.com',
                //     'password'  => bcrypt('rahasia'),
                //     'level'  => 'divisi',
                // ],
                // [
                //     'username'  => 'coba',
                //     'name'  => 'Percobaan Divisi Teknokrat',
                //     'email' => 'coba@gmail.com',
                //     'password'  => bcrypt('rahasia'),
                //     'level'  => 'divisi',
                // ],
            ]
        );

        DB::table('users')->insert([
            [
                'name' => 'Prodi Informatika',
                'username' => 'prodi_if',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Sistem Informasi',
                'username' => 'prodi_si',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Teknik Elektro',
                'username' => 'prodi_te',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Teknik Sipil',
                'username' => 'prodi_ts',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Teknik Komputer',
                'username' => 'prodi_tk',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Teknologi Informasi',
                'username' => 'prodi_ti',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi D3 SIA',
                'username' => 'prodi_sia',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Manajemen',
                'username' => 'prodi_mnj',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Akuntansi',
                'username' => 'prodi_akt',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Sastra Inggris',
                'username' => 'prodi_sasing',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi PBI',
                'username' => 'prodi_pbi',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Pend. Matematika',
                'username' => 'prodi_mtk',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Prodi Pend. Olahraga',
                'username' => 'prodi_po',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'prodi',
            ],
            [
                'name' => 'Kemahasiswaan',
                'username' => 'u_kemahasiswaan',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'LPPM',
                'username' => 'u_lppm',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'LPM',
                'username' => 'u_lpm',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'Keuangan',
                'username' => 'u_keuangan',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'Kepegawaian',
                'username' => 'u_kepegawaian',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'Kerumahtanggaan',
                'username' => 'u_kerumahtanggaan',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'PMB',
                'username' => 'u_pmb',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'Humas',
                'username' => 'u_humas',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'Pustik',
                'username' => 'u_pustik',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'LP3T',
                'username' => 'u_lp3t',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'TCTC',
                'username' => 'u_tctc',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'KUI',
                'username' => 'u_kui',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'BAAK FSIP',
                'username' => 'u_baak_fsip',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'BAAK FEB',
                'username' => 'u_baak_feb',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'BAAK FTIK',
                'username' => 'u_baak_ftik',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'Kerjasama',
                'username' => 'u_kerjasama',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'Perpus',
                'username' => 'u_perpus',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
            [
                'name' => 'LPIK',
                'username' => 'u_lpik',
                'password' => bcrypt('rahasia'),
                'level' => 'divisi',
                'divisi' => 'divisi',
            ],
        ]);

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
            ['tahun' => 2020, 'status' => 0],
            ['tahun' => 2021, 'status' => 0],
            ['tahun' => 2022, 'status' => 0],
            ['tahun' => 2023, 'status' => 0],
            ['tahun' => 2024, 'status' => 1],
        ]);
    }
}
