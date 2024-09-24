<?php

namespace Database\Seeders;

use App\Models\Tutor;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            $tutor = Tutor::create([
                'username'   => 'T' . $faker->unique()->numerify('00####'),
                'nama' => $faker->firstName . ' ' . $faker->lastName,

                'no_telepon' => '628' . $faker->numerify('###########'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'level' => 'tutor',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('users')->insert([
                'username'  => $tutor->npm,
                'name'  => $tutor->nama,
                'email' => $tutor->email,
                'password'  => bcrypt('rahasia'),
                'level'  => 'tutor',
            ]);
        }
    }
}
