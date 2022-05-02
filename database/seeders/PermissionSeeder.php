<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Staff;
use App\Models\Department;
use App\Models\Curriculum;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\Position;
use App\Models\Country;

use Hashids\Hashids;

use App\Models\VerifyUser;

use Illuminate\Support\Facades\Hash;

use Faker;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        //
        // $permissions = [
        //    'Subjecttype List',
        //    'Subjecttype Create',
        //    'Subjecttype Edit',
        //    'Subjecttype Delete',

        //    'Subject List',
        //    'Subject Create',
        //    'Subject Edit',
        //    'Subject Delete',

        //    'Grade List',
        //    'Grade Create',
        //    'Grade Edit',
        //    'Grade Delete',

        //    'Curriculum List',
        //    'Curriculum Create',
        //    'Curriculum Edit',
        //    'Curriculum Delete',

        //    'Position List',
        //    'Position Create',
        //    'Position Edit',
        //    'Position Delete',

        //    'Department List',
        //    'Department Create',
        //    'Department Edit',
        //    'Department Delete',

        //    'Staff List',
        //    'Staff Create',
        //    'Staff Edit',
        //    'Staff Delete',

        //    'Academicyear List',
        //    'Academicyear Create',
        //    'Academicyear Edit',
        //    'Academicyear Delete',

        //    'Section List',
        //    'Section Create',
        //    'Section Edit',
        //    'Section Delete',

        //    'Syllabuses List',
        //    'Syllabuses Create',
        //    'Syllabuses Edit',
        //    'Syllabuses Delete',

        //    'Fees List',
        //    'Fees Create',
        //    'Fees Edit',
        //    'Fees Delete',

        //    'Batch List',
        //    'Batch Create',
        //    'Batch Edit',
        //    'Batch Delete',

        //    'Schedule List',
        //    'Schedule Create',
        //    'Schedule Edit',
        //    'Schedule Delete',

        //    'Attendnace List',
        //    'Attendnace Create',
        //    'Attendnace Edit',
        //    'Attendnace Delete',

        //    'Exam List',
        //    'Exam Create',
        //    'Exam Edit',
        //    'Exam Delete',

        //    'Result List',
        //    'Result Create',
        //    'Result Edit',
        //    'Result Delete',

        //    'Expense List',
        //    'Expense Create',
        //    'Expense Edit',
        //    'Expense Delete',

        // ];

        // $permissions = [
        //     'Recording List',
        //    'Recording Create',
        //    'Recording Edit',
        //    'Recording Delete',
        // ];


        // foreach ($permissions as $permission) {
        //     Permission::create(['name' => $permission]);
        // }

        // $dbpermissions = Permission::whereIn('id', [82,83,84,85])->get();

        // foreach ($dbpermissions as $permission) {
        //     DB::table('model_has_permissions')->insert([
        //         'permission_id' => $permission->id,
        //         'model_type'    => 'App\Models\User',
        //         'model_id' => 2,
        //     ]);
        // }

        // foreach ($dbpermissions as $permission) {
        //     DB::table('model_has_permissions')->insert([
        //         'permission_id' => $permission->id,
        //         'model_type'    => 'App\Models\User',
        //         'model_id' => 3,
        //     ]);
        // }
        
        // $degreelists = [
        //         "Bachelor of Architecture (B.Arch.)", 
        //         "Bachelor of Arts (B.A.)", 
        //         "Bachelor of Business (B.B.)",
        //         "Bachelor of Business Administration (B.B.A.)",
        //         "Bachelor of Science in Business (B.S.B.)",
        //         "Bachelor of Canon Law (B.C.L.)",
        //         "Bachelor of Computer Science (B.C.S.)",
        //         "Bachelor of Science in Computer Science (B.S.C.S.)",
        //         "Bachelor of Criminal Justice (B.C.J.)",
        //         "Bachelor of Science in Criminal Justice (B.S.C.J.)",
        //         "Bachelor of Divinity (B.D.)",
        //         "Bachelor of Education (B.Ed.)",
        //         "Bachelor of Science in Education (B.S.Ed.)",
        //         "Bachelor of Wireless Engineering (B.W.E.)",
        //         "Bachelor of Engineering (B.E./B.Eng.)",
        //         "Bachelor of Science in Engineering (B.S.E./B.S.EN.)",
        //         "Bachelor of Science in Aerospace Engineering (B.S.A.E.)",
        //         "Bachelor of Science in Agricultural Engineering (B.S.A.E.)",
        //         "Bachelor of Science in Biological Systems (B.S.B.S.)",
        //         "Bachelor of Science in Biosystems and Agricultural Engineering (B.S.B.A.E.)",
        //         "Bachelor of Science in Biological Engineering (B.S.B.E.)",
        //         "Bachelor of Biomedical Engineering (B.B.m.E.)",
        //         "Bachelor of Science in Biomedical Engineering (B.S.B.E./B.S.B.M.E.)",
        //         "Bachelor of Science in Chemical Engineering (B.S.Ch.E.)",
        //         "Bachelor of Science in Chemical and Biomolecular Engineering (B.S.Ch.B.E.)",
        //         "Bachelor of Science in Chemical and Materials Engineering (B.S.C.M.E.)",
        //         "Bachelor of Civil Engineering (B.C.E.)",
        //         "Bachelor of Science in Civil Engineering (B.S.C.E.)",
        //         "Bachelor of Science in Civil and Infrastructure Engineering (B.S.-C.I.E.)",
        //         "Bachelor of Computer Engineering (B.Comp.E.)",
        //         "Bachelor of Science in Computer Engineering (B.S.C.E./B.S.Cmp.E.)",
        //         "Bachelor of Science in Computer Science and Engineering (B.S.C.S.E.)",
        //         "Bachelor of Science in Electrical and Computer Engineering (B.S.E.C.E.)",
        //         "Bachelor of Electrical Engineering (B.E.E.)",
        //         "Bachelor of Science in Electrical Engineering (B.S.E.E.)",
        //         "Bachelor of Science in Engineering Management (B.S.E.Mgt.)",
        //         "Bachelor of Science in Environmental Engineering (B.S.En.E./B.S.Env.E.)",                
        //         "Bachelor of Fiber Engineering (B.F.E.)",
        //         "Bachelor of Science in Industrial Engineering (B.S.I.E.)",
        //         "Bachelor of Science in Manufacturing Engineering (B.S.Mfg.E.)",
        //         "Bachelor of Science in Manufacturing Systems Engineering (B.S.M.S.E.)",
        //         "Bachelor of Science in Materials Science and Engineering (B.S.M.S.E.)",
        //         "Bachelor of Science in Materials Engineering (B.S.MA.E.)",
        //         "Bachelor of Mechanical Engineering (B.M.E.)",
        //         "Bachelor of Science in Mechanical Engineering (B.S.M.E.)",
        //         "Bachelor of Science in Metallurgical Engineering (B.S.Mt.E.)",
        //         "Bachelor of Science in Mining Engineering (B.S.MI.E.)",
        //         "Bachelor of Science in Systems (B.S.-SYST.)",
        //         "Bachelor of Software Engineering (B.S.W.E.)",
        //         "Bachelor of Science in Software Engineering (B.S.S.E.)",
        //         "Bachelor of Systems Engineering (B.S.E.)",
        //         "Bachelor of Science in Systems Engineering (B.S.S.E.)",
        //         "Bachelor of Engineering Technology (B.E.T.)",
        //         "Bachelor of Science in Engineering Technology (B.S.E.T.)",
        //         "Bachelor of Science in Civil Engineering Technology (B.S.C.E.T./B.S.Civ.E.T.)",
        //         "Bachelor of Science in Computer Engineering Technology (B.S.C.E.T.)",
        //         "Bachelor of Science in Construction Engineering Technology (B.S.Con.E.T.)",
        //         "Bachelor of Science in Drafting Design Technology (B.S.D.D.T.)",
        //         "Bachelor of Science in Electrical/Electronics Technology (B.S.E.T.)",
        //         "Bachelor of Science in Electrical Engineering Technology (B.S.E.E.T.)",
        //         "Bachelor of Science in Electro-Mechanical Engineering Technology (B.S.E.M.E.T.)",
        //         "Bachelor of Science in Mechanical Engineering Technology (B.S.M.E.T.)",
        //         "Bachelor of Fine Arts (B.F.A.)",
        //         "Bachelor of Forestry (B.F.)",
        //         "Bachelor of Science in Forest Research (B.S.For.Res.)",
        //         "Bachelor of Hebrew Letters (B.H.L.)",
        //         "Bachelor of Journalism (B.J.)",
        //         "Bachelor of Laws (LL.B.)",
        //         "Bachelor of Liberal Studies (B.L.S.)",
        //         "Bachelor of Literature (B.Lit.)",
        //         "Bachelor of Marine Science (B.M.S.)",
        //         "Bachelor of Music (B.M.)",
        //         "Bachelor of Nursing (B.N.)",
        //         "Bachelor of Science in Nursing (B.S.N.)",
        //         "Bachelor of Pharmacy (B.Pharm.)",
        //         "Bachelor of Philosophy (B.Phil.)",
        //         "Bachelor of Religious Education (B.R.E.)",
        //         "Bachelor of Science (B.S.)",
        //         "Bachelor of Science in Chemistry (B.S.Ch.)",
        //         "Bachelor of Technology (B.T./B.Tech.)"      
        //     ];
        // $profiles = [
        //     'storage/profile/user1.png',
        //     'storage/profile/user2.png',
        //     'storage/profile/user3.png',
        //     'storage/profile/user4.png',
        //     'storage/profile/user5.png',
        //     'storage/profile/user6.png',
        //     'storage/profile/user7.png',
        //     'storage/profile/user8.png',
        //     'storage/profile/user9.png',
        //     'storage/profile/user10.png',

        //     'storage/profile/user11.png',
        //     'storage/profile/user12.png',
        //     'storage/profile/user13.png',
        //     'storage/profile/user14.png',
        //     'storage/profile/user15.png',
        //     'storage/profile/user16.png',
        //     'storage/profile/user17.png',
        //     'storage/profile/user18.png',
        //     'storage/profile/user19.png',
        //     'storage/profile/user20.png',

        //     'storage/profile/user21.png',
        //     'storage/profile/user22.png',
        //     'storage/profile/user23.png',
        //     'storage/profile/user24.png',
        //     'storage/profile/user25.png',
        //     'storage/profile/user26.png',
        //     'storage/profile/user27.png',
        //     'storage/profile/user28.png',
        //     'storage/profile/user29.png',
        //     'storage/profile/user30.png',
        //     'storage/profile/user31.png',
        //     'storage/profile/user32.png',
        //     'storage/profile/user33.png',
        //     'storage/profile/user34.png'
        // ];
        // $genders = ["Male","Female"];
        // $now = Carbon::now();
        // $status = 'Active';
        // $pid1 = 2;

        // $name = $faker->name();
        // $emailhashids = new Hashids($faker->randomNumber(5, true));
        // $generateEmail = $emailhashids->encode(1, 2, 3); 

        // $schooladmin_user =User::create([
        //     'name' => $name,
        //     'email' => $generateEmail.'.smartcamp.com',
        //     'profile_photo_path' => $profiles[$faker->numberBetween(0, 29)],
        //     'email_verified_at' => $now,
        //     'school_id' => 1,
        //     'password' => Hash::make('123456789'),
        // ]);

        // VerifyUser::create([
        //     'user_id' => $schooladmin_user->id,
        //     'token' => sha1(time())
        // ]);
        // $schooladmin_user->assignRole('Principal');
        // $permissions = Permission::pluck('id')->toArray();
        // $schooladmin_user->syncPermissions($permissions);

        // $degrees = [ 
        //     $degreelists[$faker->numberBetween(0, 79)],
        //     $degreelists[$faker->numberBetween(0, 79)],
        //     $degreelists[$faker->numberBetween(0, 79)]
        // ];
        // $phoneno = [ 
        //     $faker->phoneNumber(),
        //     $faker->e164PhoneNumber()
        // ];
        // $blood = Blood::find($faker->numberBetween(1, 6));
        // $religion = Religion::find($faker->numberBetween(1, 5));
        // $position = Position::find($pid1++);
        // $country = Country::find($faker->numberBetween(1, 246));

        // $datetimebetween = $faker->dateTimeBetween();
        // $jod = date_format($datetimebetween,'Y-m-d');

        // $staff = new Staff();
        // $staff->workemail = $faker->email();
        // $staff->gender = $genders[$faker->numberBetween(0, 1)];
        // $staff->degree = json_encode($degrees);
        // $staff->nrc = $faker->creditCardNumber();
        // $staff->dob = $faker->date();
        // $staff->phone = json_encode($phoneno);
        // $staff->address = $faker->address();
        // $staff->status = $status;
        // $staff->joindate = $jod;
        // $staff->file = 'storage/cv/1612455881.pdf';
        // $staff->blood_id = $blood->id;
        // $staff->position_id = 1;
        // $staff->religion_id = $religion->id;
        // $staff->user_id = $schooladmin_user->id;
        // $staff->country_id = $country->id;
        // $staff->save();

        $permissions = Permission::pluck('id')->toArray();
        $schooladmin_user = User::find(842);
        $schooladmin_user->syncPermissions($permissions);
    }
}
