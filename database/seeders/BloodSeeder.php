<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blood;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bloodLists = array('A +', 'A -','B +', 'B -', 'O +', 'O -');

        foreach ($bloodLists as $bloodList) {
            $plan = new Blood;
            $plan->name = $bloodList;
            $plan->save();

        }
    }
}
