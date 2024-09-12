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
            ]
        );
    }
}
