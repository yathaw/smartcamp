<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gradeLists = array('Kindergarden', 'Grade - 1', 'Grade - 2', 'Grade - 3', 'Grade - 4', 'Grade - 5', 'Grade - 6', 'Grade - 7', 'Grade - 8', 'Grade - 9', 'Grade - 10', 'Grade - 11');

        foreach ($gradeLists as $gradeList) {
            $grade = new Grade;
            $grade->name = $gradeList;
            $grade->save();

        }
    }
}
