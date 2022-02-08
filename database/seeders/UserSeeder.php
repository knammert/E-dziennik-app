<?php

namespace Database\Seeders;

use App\Models\Class_name;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class_names = Class_name::pluck('id')->toArray();
        $faker = \Faker\Factory::create();

            DB::table('users')->insert([
            'name' => $faker->firstName(),
            'email' => $faker->email(),
            'password' => Hash::make('password'),
            'pesel' => rand(pow(10, 9-1), pow(10, 9)-1),
            // 'role' => rand(1,3),
            'role' => 2,
            //'class_name_id' => $faker->randomElement($class_names),
            'surname' => $faker->lastName(),
        ]);
    }
}
