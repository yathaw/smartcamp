<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
           'Subjecttype List',
           'Subjecttype Create',
           'Subjecttype Edit',
           'Subjecttype Delete',

           'Subject List',
           'Subject Create',
           'Subject Edit',
           'Subject Delete',

           'Grade List',
           'Grade Create',
           'Grade Edit',
           'Grade Delete',

           'Curriculum List',
           'Curriculum Create',
           'Curriculum Edit',
           'Curriculum Delete',

           'Position List',
           'Position Create',
           'Position Edit',
           'Position Delete',

           'Department List',
           'Department Create',
           'Department Edit',
           'Department Delete',

           'Staff List',
           'Staff Create',
           'Staff Edit',
           'Staff Delete',

           'Academicyear List',
           'Academicyear Create',
           'Academicyear Edit',
           'Academicyear Delete',

           'Section List',
           'Section Create',
           'Section Edit',
           'Section Delete',

           'Syllabuses List',
           'Syllabuses Create',
           'Syllabuses Edit',
           'Syllabuses Delete',

           'Fees List',
           'Fees Create',
           'Fees Edit',
           'Fees Delete',

           'Batch List',
           'Batch Create',
           'Batch Edit',
           'Batch Delete',

           'Schedule List',
           'Schedule Create',
           'Schedule Edit',
           'Schedule Delete',

           'Attendnace List',
           'Attendnace Create',
           'Attendnace Edit',
           'Attendnace Delete',

           'Exam List',
           'Exam Create',
           'Exam Edit',
           'Exam Delete',

           'Result List',
           'Result Create',
           'Result Edit',
           'Result Delete',

           'Expense List',
           'Expense Create',
           'Expense Edit',
           'Expense Delete',

        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $dbpermissions = Permission::get();

        foreach ($dbpermissions as $permission) {
            DB::table('model_has_permissions')->insert([
                'permission_id' => $permission->id,
                'model_type'    => 'App\Models\User',
                'model_id' => 3,
            ]);
        }
    }
}
