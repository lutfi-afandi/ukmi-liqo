<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            $anggota = Anggota::create([
                'npm'   => $faker->unique()->numerify('21######'),
                'nama' => $faker->firstName . ' ' . $faker->lastName,
                'email' => $faker->email,
                'jurusan_id' => rand(1, 10),
                'tahun_masuk' => $faker->year($max = 'now'),
                'no_telepon' => $faker->phoneNumber,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'level' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('users')->insert([
                'username'  => $anggota->npm,
                'name'  => $anggota->nama,
                'email' => $anggota->email,
                'password'  => bcrypt('rahasia'),
                'level'  => 'anggota',
            ]);
        }
    }
}
