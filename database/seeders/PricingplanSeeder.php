<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingplanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plan_school')->insert([
            'status' => 1,
            'plan_id'    => 3,
            'school_id' => 1,
            'user_id' => 2,
            'created_at' => '2020-05-01 15:14:05',

        ]);

        DB::table('plan_school')->insert([
            'status' => 1,
            'plan_id'    => 3,
            'school_id' => 1,
            'user_id' => 2,
            'created_at' => '2021-05-01 15:14:05',
        ]);

        DB::table('plan_school')->insert([
            'status' => 1,
            'plan_id'    => 3,
            'school_id' => 1,
            'user_id' => 2,
            'created_at' => '2022-04-01 15:14:05',

        ]);
    }
}
