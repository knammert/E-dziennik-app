<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Class_name_subject;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //specific activity grade seeder
        $random = array("1", "1.5", "1.75","2", "2.5", "2.75","3", "3.5", "3.75","4", "4.5", "4.75","5", "5.5", "5.75","6");
        $randomComments = array("Sprawdzian", "Kartkówka", "Odpowiedź ustna");
        // for ($i=0; $i < 60; $i++) {
        //     $user = User::where('class_name_id',1 )->inRandomOrder()->first();
        //     $randomGrade = $random[array_rand($random)];
        //     $randomWeight = $random[array_rand($random)];
        //     $randomComment = $randomComments[array_rand($randomComments)];

        //     DB::table('grades')->insert([
        //         'user_id' => $user->id,
        //         'class_name_subject_id' => 42,
        //         'grade' => $randomGrade,
        //         'weight' => $randomWeight,
        //         'comment' => $randomComment,
        //         'semestr' => '1',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }
    //specific user grade seeder
         for ($i=0; $i < 20; $i++) {
            $class_name_subject_id = Class_name_subject::where('class_name_id',1 )->inRandomOrder()->first();
            $randomGrade = $random[array_rand($random)];
            $randomWeight = $random[array_rand($random)];
            $randomComment = $randomComments[array_rand($randomComments)];

            DB::table('grades')->insert([
                'user_id' => 2,
                'class_name_subject_id' => $class_name_subject_id->id,
                'grade' => $randomGrade,
                'weight' => $randomWeight,
                'comment' => $randomComment,
                'semestr' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
