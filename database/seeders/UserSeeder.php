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

        // for ($i=0; $i < 25; $i++) {
        //     DB::table('users')->insert([
        //         'name' => $faker->firstName(),
        //         'email' => $faker->email(),
        //         'password' => Hash::make('password'),
        //         'pesel' => rand(pow(10, 9-1), pow(10, 9)-1),
        //         // 'role' => rand(1,3),
        //         'role' => 1,
        //         //'class_name_id' => $faker->randomElement($class_names),
        //         'class_name_id' => 1,
        //         'surname' => $faker->lastName(),
        //     ]);
        // }

        // for ($i=0; $i < 18; $i++) {
        //     DB::table('users')->insert([
        //         'name' => $faker->firstName(),
        //         'email' => $faker->email(),
        //         'password' => Hash::make('password'),
        //         'pesel' => rand(pow(10, 9-1), pow(10, 9)-1),
        //         // 'role' => rand(1,3),
        //         'role' => 1,
        //         //'class_name_id' => $faker->randomElement($class_names),
        //         'class_name_id' => 2,
        //         'surname' => $faker->lastName(),
        //     ]);
        // }

        // for ($i=0; $i < 21; $i++) {
        //     DB::table('users')->insert([
        //         'name' => $faker->firstName(),
        //         'email' => $faker->email(),
        //         'password' => Hash::make('password'),
        //         'pesel' => rand(pow(10, 9-1), pow(10, 9)-1),
        //         // 'role' => rand(1,3),
        //         'role' => 1,
        //         //'class_name_id' => $faker->randomElement($class_names),
        //         'class_name_id' => 3,
        //         'surname' => $faker->lastName(),
        //     ]);
        // }

        // for ($i=0; $i < 25; $i++) {
        //     DB::table('users')->insert([
        //         'name' => $faker->firstName(),
        //         'email' => $faker->email(),
        //         'password' => Hash::make('password'),
        //         'pesel' => rand(pow(10, 9-1), pow(10, 9)-1),
        //         // 'role' => rand(1,3),
        //         'role' => 1,
        //         //'class_name_id' => $faker->randomElement($class_names),
        //         'class_name_id' => 4,
        //         'surname' => $faker->lastName(),
        //     ]);
        // }

        for ($i=0; $i < 9; $i++) {
            DB::table('users')->insert([
                'name' => $faker->firstName(),
                'email' => $faker->email(),
                'password' => Hash::make('password'),
                'pesel' => rand(pow(10, 9-1), pow(10, 9)-1),
                // 'role' => rand(1,3),
                'role' => 2,
                //'class_name_id' => $faker->randomElement($class_names),
                'class_name_id' => 0,
                'surname' => $faker->lastName(),
            ]);
        }


    }
}
