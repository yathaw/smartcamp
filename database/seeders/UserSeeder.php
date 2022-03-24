<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\VerifyUser;

use Illuminate\Support\Facades\Hash;
use Faker;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $now = Carbon::now();

        $softwareadmin_user1 =User::create([
            'name' => $faker->firstNameMale,
            'email' => 'adminone.smartcamp.com',
            'email_verified_at' => $now,
            'password' => Hash::make('123456789'),
        ]);

        VerifyUser::create([
            'user_id' => $softwareadmin_user1->id,
            'token' => sha1(time())
        ]);
        $softwareadmin_user1->assignRole('Software Admin');

        $softwareadmin_user2 =User::create([
            'name' => $faker->firstNameFemale,
            'email' => 'admintwo.smartcamp.com',
            'email_verified_at' => $now,
            'password' => Hash::make('123456789'),
        ]);

        VerifyUser::create([
            'user_id' => $softwareadmin_user2->id,
            'token' => sha1(time())
        ]);
        $softwareadmin_user2->assignRole('Software Admin');

        $schooladmin_user =User::create([
            'name' => $faker->firstNameFemale,
            'email' => 'school1_admin.smartcamp.com',
            'email_verified_at' => $now,
            'password' => Hash::make('123456789'),
        ]);

        VerifyUser::create([
            'user_id' => $schooladmin_user->id,
            'token' => sha1(time())
        ]);
        $schooladmin_user->assignRole('School Admin');

        $schoolprincipal_user =User::create([
            'name' => $faker->firstNameFemale,
            'email' => 'school2_principal@gmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('123456789'),
        ]);

        VerifyUser::create([
            'user_id' => $schoolprincipal_user->id,
            'token' => sha1(time())
        ]);
        $schoolprincipal_user->assignRole('Principal');
    }
}
