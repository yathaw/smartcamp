<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planLists = [
            array('Weekly', '$25', '7 Days'),
            array('Monthly', '$50', '1 Month'),
            array('Yearly', '$199', '1 Year')
        ];

        foreach ($planLists as $planList) {
            $plan = new Plan;
            $plan->name = $planList[0];
            $plan->amount = $planList[1];
            $plan->duration = $planList[2];
            $plan->save();

        }
    }
}
