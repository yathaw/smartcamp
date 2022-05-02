<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;
use App\Models\Department;
use App\Models\Curriculum;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\Position;
use App\Models\Country;
use Spatie\Permission\Models\Permission;

use Hashids\Hashids;

use App\Models\VerifyUser;

use Illuminate\Support\Facades\Hash;

use Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubjectTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $myanmarids = [38,1,26,27,28,29,30,31,32,33,34,36,37]; // 15
        $engids = [2,9,39]; // 9
        $mathids = [41,3,23,24]; //8
        $scienceids = [4,5]; // 17
        $historyids = [35, 25, 22]; // 14
        $geographyids = [21,25]; // 13
        $uppersecondaryids = [17,18,19,20]; // 12
        $artids = [7,40,12,10]; // 10
        $musicids = [11,14]; // 16
        $computingids = [16,15]; // 11
        $ethicsids = [8,6,13 ]; // 18

        $faker = \Faker\Factory::create();
        $now = Carbon::now();

        $myanmarLists = Staff::where('position_id', 15)->get();
        foreach($myanmarLists as $myanmarList){
            $userid = $myanmarList->user->id;
            $subjectid = $myanmarids[$faker->numberBetween(0, 12)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $engLists = Staff::where('position_id', 9)->get();
        foreach($engLists as $engList){
            $userid = $engList->user->id;
            $subjectid = $engids[$faker->numberBetween(0, 2)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $mathLists = Staff::where('position_id', 8)->get();
        foreach($mathLists as $mathList){
            $userid = $mathList->user->id;
            $subjectid = $mathids[$faker->numberBetween(0, 3)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $scienceLists = Staff::where('position_id', 17)->get();
        foreach($scienceLists as $scienceList){
            $userid = $scienceList->user->id;
            $subjectid = $scienceids[$faker->numberBetween(0, 1)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $historyLists = Staff::where('position_id', 14)->get();
        foreach($historyLists as $historyList){
            $userid = $historyList->user->id;
            $subjectid = $historyids[$faker->numberBetween(0, 2)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $geographyLists = Staff::where('position_id', 13)->get();
        foreach($geographyLists as $geographyList){
            $userid = $geographyList->user->id;
            $subjectid = $geographyids[$faker->numberBetween(0, 1)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $uppersecondaryLists = Staff::where('position_id', 12)->get();
        foreach($uppersecondaryLists as $uppersecondaryList){
            $userid = $uppersecondaryList->user->id;
            $subjectid = $uppersecondaryids[$faker->numberBetween(0, 3)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $artLists = Staff::where('position_id', 10)->get();
        foreach($artLists as $artList){
            $userid = $artList->user->id;
            $subjectid = $artids[$faker->numberBetween(0, 3)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $musicLists = Staff::where('position_id', 16)->get();
        foreach($musicLists as $musicList){
            $userid = $musicList->user->id;
            $subjectid = $musicids[$faker->numberBetween(0, 1)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $computingLists = Staff::where('position_id', 11)->get();
        foreach($computingLists as $computingList){
            $userid = $computingList->user->id;
            $subjectid = $computingids[$faker->numberBetween(0, 1)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $ethicsLists = Staff::where('position_id', 18)->get();
        foreach($ethicsLists as $ethicsList){
            $userid = $ethicsList->user->id;
            $subjectid = $ethicsids[$faker->numberBetween(0, 2)];

            DB::table('subject_user')->insert([
                'subject_id'      => $subjectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
    }
}
