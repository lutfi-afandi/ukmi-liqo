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
                    'username'  => 'tutor',
                    'name'  => 'Tutor LIQO',
                    'email' => 'tutor@gmail.com',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'tutor',
                ],
                [
                    'username'  => 'anggota',
                    'name'  => 'Anggota UKMI 1',
                    'email' => 'anggota@gmail.com',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'anggota',
                ],
            ]
        );
    }
}
