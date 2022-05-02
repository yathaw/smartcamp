<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Period;

class AcademicyearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodLists = [
            // array('2020-2021 ပညာသင်နှစ်', 2020, 2021),
            array('2021-2022 ပညာသင်နှစ်', 2021, 2022),
            array('2022-2023 ပညာသင်နှစ်', 2022, 2023)
        ];

        foreach ($periodLists as $periodList) {
            $period = new Period;
            $period->name = $periodList[0];
            $period->startyear = $periodList[1];
            $period->endyear = $periodList[2];
            $period->school_id = 1;
            $period->save();
        }
    }
}
