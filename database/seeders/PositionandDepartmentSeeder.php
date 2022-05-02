<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;
use App\Models\Department;


class PositionandDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departmentLists = [
            array(1, 'Senior Leadership Team', '1', 1, '2022-02-20 02:05:50', '2022-02-24 06:38:51'),
            array(2, 'Subject Leaders', '2', 1, '2022-02-20 02:55:27', '2022-02-20 03:36:08'),
            array(3, 'Learning Support', '3', 1, '2022-02-20 06:13:16', '2022-02-20 06:13:16'),
            array(4, 'Administration Staff', '4', 1, '2022-02-20 06:14:03', '2022-02-20 06:14:03'),
            array(5, 'Kitchen and Cleaning Staff', '5', 1, '2022-02-20 06:14:35', '2022-02-20 06:14:35')
        ];

        foreach($departmentLists as $departmentList){
            $department = new Department;
            $department->name = $departmentList[1];
            $department->sorting = $departmentList[2];
            $department->school_id = $departmentList[3];
            $department->save();
        }



        $positionLists = [
            array(1, 'Principal', '1', 1, 1, NULL, '2022-02-20 02:05:50', '2022-02-20 06:05:56'),
            array(2, 'Vice Principal', '2', 1, 1, NULL, '2022-02-20 02:05:50', '2022-02-20 06:05:56'),
            array(3, 'Assistant Principal', '3', 1, 1, NULL, '2022-02-20 02:05:50', '2022-02-20 06:05:56'),
            array(4, 'School Business Manager', '4', 1, 1, NULL, '2022-02-20 02:05:50', '2022-02-20 06:05:56'),
            array(5, 'Student Welfare Manager', '5', 1, 1, NULL, '2022-02-20 02:05:50', '2022-02-20 06:05:56'),
            array(6, 'Registrar & Admissions Manager', '6', 1, 1, NULL, '2022-02-20 02:05:50', '2022-02-20 06:05:56'),
            array(7, 'Finance and Human Resources Director', '7', 1, 1, NULL, '2022-02-20 02:05:50', '2022-02-20 06:05:56'),
            array(8, 'Head of Mathematics', '1', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(9, 'Head of English', '2', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(10, 'Head of Art', '3', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(11, 'Head of Computing', '4', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(12, 'Head of Uppersecondary', '5', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(13, 'Head of Geography', '6', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(14, 'Head of History', '7', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(15, 'Head of Myanmar', '8', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(16, 'Head of Music', '9', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(17, 'Head of Science', '10', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(18, 'Head of Ethics', '11', 2, 1, NULL, '2022-02-20 02:55:27', '2022-02-20 02:55:27'),
            array(19, 'Testing update', '8', 1, 1, '2022-02-20 06:06:07', '2022-02-20 06:03:50', '2022-02-20 06:06:07'),
            array(20, 'Full-Time Guide', '1', 3, 1, NULL, '2022-02-20 06:13:16', '2022-02-20 06:13:16'),
            array(21, 'Part-Time Guide', '2', 3, 1, NULL, '2022-02-20 06:13:16', '2022-02-20 06:13:16'),
            array(22, 'Student Welfare/Technician', '1', 4, 1, NULL, '2022-02-20 06:14:03', '2022-02-20 06:14:03'),
            array(23, 'Receptionist', '2', 4, 1, NULL, '2022-02-20 06:14:03', '2022-02-20 06:14:03'),
            array(24, 'Heads PA/Office Manager', '3', 4, 1, NULL, '2022-02-20 06:14:03', '2022-02-20 06:14:03'),
            array(25, 'Exams Officer/Data Manager', '4', 4, 1, NULL, '2022-02-20 06:14:03', '2022-02-20 06:14:03'),
            array(26, 'Cover Supervisor', '5', 4, 1, NULL, '2022-02-20 06:14:03', '2022-02-20 06:14:03'),
            array(27, 'Kitchen Manager', '1', 5, 1, NULL, '2022-02-20 06:14:35', '2022-02-20 06:14:35'),
            array(28, 'Cook', '2', 5, 1, NULL, '2022-02-20 06:14:35', '2022-02-20 06:14:35'),
            array(29, 'Kitchen Assistant', '3', 5, 1, NULL, '2022-02-20 06:14:35', '2022-02-20 06:14:35')
        ];

        foreach ($positionLists as $positionList) {
            $position = new Position;
            $position->name = $positionList[1];
            $position->sorting = $positionList[2];
            $position->department_id = $positionList[3];
            $position->school_id = $positionList[4];
            $position->save();
        }
    }
}
