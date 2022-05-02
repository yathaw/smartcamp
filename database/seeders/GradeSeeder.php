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
        $gradeLists = [
            array(1, 'Kindergarden', '#000000', '#FFD86B', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(2, 'Grade - 1', '#FFFFFF', '#B92000', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(3, 'Grade - 2', '#FFFFFF', '#000000', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(4, 'Grade - 3', '#000000', '#8DE25B', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(5, 'Grade - 4', '#FFFFFF', '#2B2C82', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(6, 'Grade - 5', '#000000', '#3AB7F6', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(7, 'Grade - 6', '#000000', '#B92000', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(8, 'Grade - 7', '#000000', '#FA9B1E', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(9, 'Grade - 8', '#FFFFFF', '#E7556E', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(10, 'Grade - 9', '#FFFFFF', '#B92CA9', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(11, 'Grade - 10', '#FFFFFF', '#7414A0', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(12, 'Grade - 11', '#000000', '#35C5C7', NULL, '2022-02-04 08:34:36', '2022-02-04 08:34:36'),
            array(13, 'Grade - 12', '#FFFFFF', '#FF704F', NULL, NULL, NULL)
        ];

        foreach ($gradeLists as $gradeList) {
            $grade = new Grade;
            $grade->name = $gradeList[1];
            $grade->txtcolor = $gradeList[2];
            $grade->bgcolor = $gradeList[3];

            $grade->save();

        }
    }
}
