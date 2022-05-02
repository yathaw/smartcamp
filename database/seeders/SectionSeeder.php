<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use Faker;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $sectionLists = [
            // array($faker->randomNumber(8, true), 150000, 'Installment', '2020-06-01', '2021-02-28', '12:00:00', '17:00:00',1, 1),
            // array($faker->randomNumber(8, true), 170000, 'Installment', '2020-06-01', '2021-02-28', '12:00:00', '17:00:00',1, 2),
            // array($faker->randomNumber(8, true), 170000, 'Installment', '2020-06-01', '2021-02-28', '12:00:00', '17:00:00',1, 3),
            // array($faker->randomNumber(8, true), 190000, 'Installment', '2020-06-01', '2021-02-28', '12:00:00', '17:00:00',1, 4),
            // array($faker->randomNumber(8, true), 190000, 'Installment', '2020-06-01', '2021-02-28', '12:00:00', '17:00:00',1, 5),
            // array($faker->randomNumber(8, true), 200000, 'Installment', '2020-06-01', '2021-02-28', '12:00:00', '17:00:00',1, 6),
            // array($faker->randomNumber(8, true), 200000, 'Installment', '2020-06-01', '2021-02-28', '12:00:00', '17:00:00',1, 7),

            // array($faker->randomNumber(8, true), 200000, 'Installment', '2020-06-01', '2021-02-28', '07:00:00', '12:00:00',1, 8),
            // array($faker->randomNumber(8, true), 220000, 'Installment', '2020-06-01', '2021-02-28', '07:00:00', '12:00:00',1, 9),

            // array($faker->randomNumber(8, true), 220000, 'Installment', '2020-06-01', '2021-02-28', '07:00:00', '12:00:00',1, 10),
            // array($faker->randomNumber(8, true), 300000, 'Installment', '2020-06-01', '2021-02-28', '07:00:00', '12:00:00',1, 11),
            // array($faker->randomNumber(8, true), 300000, 'Installment', '2020-06-01', '2021-02-28', '07:00:00', '12:00:00',1, 12),
            // array($faker->randomNumber(8, true), 300000, 'Installment', '2020-06-01', '2021-02-28', '07:00:00', '12:00:00',1, 13),

            // // - -
            array($faker->randomNumber(8, true), 150000, 'Installment', '2021-06-01', '2022-02-28', '12:00:00', '17:00:00',2, 1),
            array($faker->randomNumber(8, true), 170000, 'Installment', '2021-06-01', '2022-02-28', '12:00:00', '17:00:00',2, 2),
            array($faker->randomNumber(8, true), 170000, 'Installment', '2021-06-01', '2022-02-28', '12:00:00', '17:00:00',2, 3),
            array($faker->randomNumber(8, true), 190000, 'Installment', '2021-06-01', '2022-02-28', '12:00:00', '17:00:00',2, 4),
            array($faker->randomNumber(8, true), 190000, 'Installment', '2021-06-01', '2022-02-28', '12:00:00', '17:00:00',2, 5),
            array($faker->randomNumber(8, true), 200000, 'Installment', '2021-06-01', '2022-02-28', '12:00:00', '17:00:00',2, 6),
            array($faker->randomNumber(8, true), 200000, 'Installment', '2021-06-01', '2022-02-28', '12:00:00', '17:00:00',2, 7),

            array($faker->randomNumber(8, true), 200000, 'Installment', '2021-06-01', '2022-02-28', '07:00:00', '12:00:00',2, 8),
            array($faker->randomNumber(8, true), 220000, 'Installment', '2021-06-01', '2022-02-28', '07:00:00', '12:00:00',2, 9),

            array($faker->randomNumber(8, true), 220000, 'Installment', '2021-06-01', '2022-02-28', '07:00:00', '12:00:00',2, 10),
            array($faker->randomNumber(8, true), 300000, 'Installment', '2021-06-01', '2022-02-28', '07:00:00', '12:00:00',2, 11),
            array($faker->randomNumber(8, true), 300000, 'Installment', '2021-06-01', '2022-02-28', '07:00:00', '12:00:00',2, 12),
            array($faker->randomNumber(8, true), 300000, 'Installment', '2021-06-01', '2022-02-28', '07:00:00', '12:00:00',2, 13)

            // array($faker->randomNumber(8, true), 150000, 'Installment', '2022-06-01', '2023-02-28', '12:00:00', '17:00:00',3, 1),
            // array($faker->randomNumber(8, true), 170000, 'Installment', '2022-06-01', '2023-02-28', '12:00:00', '17:00:00',3, 2),
            // array($faker->randomNumber(8, true), 170000, 'Installment', '2022-06-01', '2023-02-28', '12:00:00', '17:00:00',3, 3),
            // array($faker->randomNumber(8, true), 190000, 'Installment', '2022-06-01', '2023-02-28', '12:00:00', '17:00:00',3, 4),
            // array($faker->randomNumber(8, true), 190000, 'Installment', '2022-06-01', '2023-02-28', '12:00:00', '17:00:00',3, 5),
            // array($faker->randomNumber(8, true), 200000, 'Installment', '2022-06-01', '2023-02-28', '12:00:00', '17:00:00',3, 6),
            // array($faker->randomNumber(8, true), 200000, 'Installment', '2022-06-01', '2023-02-28', '12:00:00', '17:00:00',3, 7),

            // array($faker->randomNumber(8, true), 200000, 'Installment', '2022-06-01', '2023-02-28', '07:00:00', '12:00:00',3, 8),
            // array($faker->randomNumber(8, true), 220000, 'Installment', '2022-06-01', '2023-02-28', '07:00:00', '12:00:00',3, 9),

            // array($faker->randomNumber(8, true), 220000, 'Installment', '2022-06-01', '2023-02-28', '07:00:00', '12:00:00',3, 10),
            // array($faker->randomNumber(8, true), 300000, 'Installment', '2022-06-01', '2023-02-28', '07:00:00', '12:00:00',3, 11),
            // array($faker->randomNumber(8, true), 300000, 'Installment', '2022-06-01', '2023-02-28', '07:00:00', '12:00:00',3, 12),
            // array($faker->randomNumber(8, true), 300000, 'Installment', '2022-06-01', '2023-02-28', '07:00:00', '12:00:00',3, 13),
        ];

        foreach ($sectionLists as $sectionList) {
            $section = new Section;
            $section->codeno = $sectionList[0];
            $section->price = $sectionList[1];
            $section->pricetype = $sectionList[2];
            $section->startdate = $sectionList[3];
            $section->enddate = $sectionList[4];
            $section->starttime = $sectionList[5];
            $section->endtime = $sectionList[6];
            $section->period_id = 1;
            $section->grade_id = $sectionList[8];
            $section->user_id = 2;
            $section->school_id = 1;
            $section->save();
        }

        $sections = Section::all();

        foreach($sections as $section){
            $s = Section::find($section->id);
            $s->currency_id = 143;
            $s->save();
        }
    }
}
