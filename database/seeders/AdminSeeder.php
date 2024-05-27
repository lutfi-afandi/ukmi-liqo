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
                    'username'  => 'programmer',
                    'name'  => 'Lutfi Afandi',
                    'email' => 'lutfi@gmail.com',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'divisi',
                ],
            ]
        );
        DB::table('kategoris')->insert(
            [
                [
                    'nama_kategori'  => 'Standar Pendidikan',
                ],
                [
                    'nama_kategori'  => 'Standar Penelitian',
                ],
                [
                    'nama_kategori'  => 'Standar Pengabdian Masyarakat',
                ],
            ]
        );
    }
}
