<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;
use App\Models\Department;
use App\Models\Curriculum;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\Position;
use App\Models\Country;
use Spatie\Permission\Models\Permission;

use Hashids\Hashids;

use App\Models\VerifyUser;

use Illuminate\Support\Facades\Hash;

use Faker;
use Carbon\Carbon;
class StaffSeeder extends Seeder
{
    // Teacher
    
    public function run()
    {
        $degreelists = [
                "Bachelor of Architecture (B.Arch.)", 
                "Bachelor of Arts (B.A.)", 
                "Bachelor of Business (B.B.)",
                "Bachelor of Business Administration (B.B.A.)",
                "Bachelor of Science in Business (B.S.B.)",
                "Bachelor of Canon Law (B.C.L.)",
                "Bachelor of Computer Science (B.C.S.)",
                "Bachelor of Science in Computer Science (B.S.C.S.)",
                "Bachelor of Criminal Justice (B.C.J.)",
                "Bachelor of Science in Criminal Justice (B.S.C.J.)",
                "Bachelor of Divinity (B.D.)",
                "Bachelor of Education (B.Ed.)",
                "Bachelor of Science in Education (B.S.Ed.)",
                "Bachelor of Wireless Engineering (B.W.E.)",
                "Bachelor of Engineering (B.E./B.Eng.)",
                "Bachelor of Science in Engineering (B.S.E./B.S.EN.)",
                "Bachelor of Science in Aerospace Engineering (B.S.A.E.)",
                "Bachelor of Science in Agricultural Engineering (B.S.A.E.)",
                "Bachelor of Science in Biological Systems (B.S.B.S.)",
                "Bachelor of Science in Biosystems and Agricultural Engineering (B.S.B.A.E.)",
                "Bachelor of Science in Biological Engineering (B.S.B.E.)",
                "Bachelor of Biomedical Engineering (B.B.m.E.)",
                "Bachelor of Science in Biomedical Engineering (B.S.B.E./B.S.B.M.E.)",
                "Bachelor of Science in Chemical Engineering (B.S.Ch.E.)",
                "Bachelor of Science in Chemical and Biomolecular Engineering (B.S.Ch.B.E.)",
                "Bachelor of Science in Chemical and Materials Engineering (B.S.C.M.E.)",
                "Bachelor of Civil Engineering (B.C.E.)",
                "Bachelor of Science in Civil Engineering (B.S.C.E.)",
                "Bachelor of Science in Civil and Infrastructure Engineering (B.S.-C.I.E.)",
                "Bachelor of Computer Engineering (B.Comp.E.)",
                "Bachelor of Science in Computer Engineering (B.S.C.E./B.S.Cmp.E.)",
                "Bachelor of Science in Computer Science and Engineering (B.S.C.S.E.)",
                "Bachelor of Science in Electrical and Computer Engineering (B.S.E.C.E.)",
                "Bachelor of Electrical Engineering (B.E.E.)",
                "Bachelor of Science in Electrical Engineering (B.S.E.E.)",
                "Bachelor of Science in Engineering Management (B.S.E.Mgt.)",
                "Bachelor of Science in Environmental Engineering (B.S.En.E./B.S.Env.E.)",                
                "Bachelor of Fiber Engineering (B.F.E.)",
                "Bachelor of Science in Industrial Engineering (B.S.I.E.)",
                "Bachelor of Science in Manufacturing Engineering (B.S.Mfg.E.)",
                "Bachelor of Science in Manufacturing Systems Engineering (B.S.M.S.E.)",
                "Bachelor of Science in Materials Science and Engineering (B.S.M.S.E.)",
                "Bachelor of Science in Materials Engineering (B.S.MA.E.)",
                "Bachelor of Mechanical Engineering (B.M.E.)",
                "Bachelor of Science in Mechanical Engineering (B.S.M.E.)",
                "Bachelor of Science in Metallurgical Engineering (B.S.Mt.E.)",
                "Bachelor of Science in Mining Engineering (B.S.MI.E.)",
                "Bachelor of Science in Systems (B.S.-SYST.)",
                "Bachelor of Software Engineering (B.S.W.E.)",
                "Bachelor of Science in Software Engineering (B.S.S.E.)",
                "Bachelor of Systems Engineering (B.S.E.)",
                "Bachelor of Science in Systems Engineering (B.S.S.E.)",
                "Bachelor of Engineering Technology (B.E.T.)",
                "Bachelor of Science in Engineering Technology (B.S.E.T.)",
                "Bachelor of Science in Civil Engineering Technology (B.S.C.E.T./B.S.Civ.E.T.)",
                "Bachelor of Science in Computer Engineering Technology (B.S.C.E.T.)",
                "Bachelor of Science in Construction Engineering Technology (B.S.Con.E.T.)",
                "Bachelor of Science in Drafting Design Technology (B.S.D.D.T.)",
                "Bachelor of Science in Electrical/Electronics Technology (B.S.E.T.)",
                "Bachelor of Science in Electrical Engineering Technology (B.S.E.E.T.)",
                "Bachelor of Science in Electro-Mechanical Engineering Technology (B.S.E.M.E.T.)",
                "Bachelor of Science in Mechanical Engineering Technology (B.S.M.E.T.)",
                "Bachelor of Fine Arts (B.F.A.)",
                "Bachelor of Forestry (B.F.)",
                "Bachelor of Science in Forest Research (B.S.For.Res.)",
                "Bachelor of Hebrew Letters (B.H.L.)",
                "Bachelor of Journalism (B.J.)",
                "Bachelor of Laws (LL.B.)",
                "Bachelor of Liberal Studies (B.L.S.)",
                "Bachelor of Literature (B.Lit.)",
                "Bachelor of Marine Science (B.M.S.)",
                "Bachelor of Music (B.M.)",
                "Bachelor of Nursing (B.N.)",
                "Bachelor of Science in Nursing (B.S.N.)",
                "Bachelor of Pharmacy (B.Pharm.)",
                "Bachelor of Philosophy (B.Phil.)",
                "Bachelor of Religious Education (B.R.E.)",
                "Bachelor of Science (B.S.)",
                "Bachelor of Science in Chemistry (B.S.Ch.)",
                "Bachelor of Technology (B.T./B.Tech.)"      
            ];
        

        $faker = \Faker\Factory::create();

        $now = Carbon::now();

        $profiles = [
            'storage/profile/user1.png',
            'storage/profile/user2.png',
            'storage/profile/user3.png',
            'storage/profile/user4.png',
            'storage/profile/user5.png',
            'storage/profile/user6.png',
            'storage/profile/user7.png',
            'storage/profile/user8.png',
            'storage/profile/user9.png',
            'storage/profile/user10.png',

            'storage/profile/user11.png',
            'storage/profile/user12.png',
            'storage/profile/user13.png',
            'storage/profile/user14.png',
            'storage/profile/user15.png',
            'storage/profile/user16.png',
            'storage/profile/user17.png',
            'storage/profile/user18.png',
            'storage/profile/user19.png',
            'storage/profile/user20.png',

            'storage/profile/user21.png',
            'storage/profile/user22.png',
            'storage/profile/user23.png',
            'storage/profile/user24.png',
            'storage/profile/user25.png',
            'storage/profile/user26.png',
            'storage/profile/user27.png',
            'storage/profile/user28.png',
            'storage/profile/user29.png',
            'storage/profile/user30.png',
            'storage/profile/user31.png',
            'storage/profile/user32.png',
            'storage/profile/user33.png',
            'storage/profile/user34.png'
        ];
        $genders = ["Male","Female"];

        $status = 'Active';
        $pid1 = 2;

        $name = $faker->name();
        $emailhashids = new Hashids($faker->randomNumber(5, true));
        $generateEmail = $emailhashids->encode(1, 2, 3); 

        $schooladmin_user =User::create([
            'name' => $name,
            'email' => $generateEmail.'.smartcamp.com',
            'profile_photo_path' => $profiles[$faker->numberBetween(0, 29)],
            'email_verified_at' => $now,
            'school_id' => 1,
            'password' => Hash::make('123456789'),
        ]);

        VerifyUser::create([
            'user_id' => $schooladmin_user->id,
            'token' => sha1(time())
        ]);
        $schooladmin_user->assignRole('School Admin');
        $permissions = Permission::pluck('id')->toArray();
        $schooladmin_user->syncPermissions($permissions);

        $degrees = [ 
            $degreelists[$faker->numberBetween(0, 79)],
            $degreelists[$faker->numberBetween(0, 79)],
            $degreelists[$faker->numberBetween(0, 79)]
        ];
        $phoneno = [ 
            $faker->phoneNumber(),
            $faker->e164PhoneNumber()
        ];
        $blood = Blood::find($faker->numberBetween(1, 6));
        $religion = Religion::find($faker->numberBetween(1, 5));
        $position = Position::find($pid1++);
        $country = Country::find($faker->numberBetween(1, 246));

        $datetimebetween = $faker->dateTimeBetween();
        $jod = date_format($datetimebetween,'Y-m-d');

        $staff = new Staff();
        $staff->workemail = $faker->email();
        $staff->gender = $genders[$faker->numberBetween(0, 1)];
        $staff->degree = json_encode($degrees);
        $staff->nrc = $faker->creditCardNumber();
        $staff->dob = $faker->date();
        $staff->phone = json_encode($phoneno);
        $staff->address = $faker->address();
        $staff->status = $status;
        $staff->joindate = $jod;
        $staff->file = 'storage/cv/1612455881.pdf';
        $staff->blood_id = $blood->id;
        $staff->religion_id = $religion->id;
        $staff->user_id = $schooladmin_user->id;
        $staff->country_id = $country->id;
        $staff->save();

        $nameLists = [
            "Zaw Ye Wunna Ye",
            "Kaung Thuta Thuta Htut",
            "Wunna Thiha",
            "Wai Ye",
            "Phone Naing Thant",
            "Myat Zarni Myo"
        ];
        for ($i=0; $i < 6; $i++) { 

            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = Position::find($pid1++);
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Staff');

            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);


            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position['id'];
            $staff->country_id = $country->id;
            $staff->save();



        }

        $nameLists = [
            "Ag Thant Wai Hein",
            "Soe Zaw",
            "Hein Kyaw",
            "Htut Aung",
            "Pyae Myat",
            "Kyaw Thawda",
            "Min Zarni Sein",
            "Mg Soe Kyaw U",
            "Tun Ag",
            "Ye Pyae",
            "Min Pyay Zeyar Pyay",
            "Min Kaung Myo Ye"
        ];
        
        for ($i=0; $i < 12; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 8;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }
        $nameLists = [
            "Phyo Zarni U",
            "Zaw Win",
            "U Min",
            "Hein Thant Soe",
            "Linn Sein",
            "Min Thet Myat Arkar",
            "Hein Thura Thurein Phyo",
            "Pyae Thiha Phyoe Thura",
            "Thu Myat",
            "Thawda Thurein",
            "U Mg",
            "Thawda Wai Thawda Aung",
            "Htut Phyo",
            "Khine Phyo",
            "Myat Ag Wunna Phyoe"
            
        ];

        

        for ($i=0; $i < 15; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 9;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "Yarzar Ko Thuta Pyae",
            "Phone Pyay",
            "Zarni Ko Thant Myo",
            "Zeyar Kyaw Maung",
            "Aung Zeyar Pyae"
        ];

        for ($i=0; $i < 5; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 10;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }
        $nameLists = [
            "Pyay Khant",
            "Zeyar Khant Wunna Hein",
            "Maung Naing"
        ];

        for ($i=0; $i < 3; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 11;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }
        $nameLists = [
            "Zeya Mg Hein Min",
            "Myat Thurein Yarzar Win",
            "Lin Wunna Khaing Bo",
            "Thawda Thura Win Lin",
            "Khaing Ag",
            "Min Kaung Myo Ye",
            "Ye Mg Htet Kaung",
            "Myo Zarni",
            "Thuta Thiha Mg Zarni",
            "Zeyar Phone"
        ];

        
        for ($i=0; $i < 10; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 12;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "Thurein Myat",
            "Lin Htet",
            "Khine Soe",
            "Thurein Zeya"
        ];

        for ($i=0; $i < 4; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 13;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $faker->name();
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "Mg Tun U",
            "Hein Thant Soe",
            "Win Phyoe Zaw",
            "Win Tun Htet",
            "Pyay Kyaw Yaza Wai"
        ];
        for ($i=0; $i < 5; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 14;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "Soe Zaw",
            "Pyay Myat Ko Zeyar",
            "Zaw Thurein Phone",
            "Arkar Thuta Hein Phyoe",
            "Kan Kaung Wai Wai",
            "Sein Sein",
            "Win Thant",
            "Zarni Phone Wunna",
            "Naing Yarzar Sein Mg",
            "Thura Khine",
            "Myint Yaza",
            "Zarni Zaw Min Thiha",
            "Wunna Thant Soe Zaw",
            "Win Maung",
            "Thet Pyay Thura Pyay",
            "Kan Bo Thant",
            "Wai Min",
            "Thawda Myat Htet Yaza",
            "Nyan Pyay",
            "Myo Win Kan"
        ];

        for ($i=0; $i < 20; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 15;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "U Zaw Mg",
            "Htun Kyaw Wai Zin",
            "Win Tun"
        ];

        for ($i=0; $i < 3; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 16;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "Kyaw Khine",
            "Zeya Thet U Sein",
            "Myat Pyay Aung Khant",
            "Maung Thawda",
            "Thuta Thuta Khaing Yaza",
            "Ag Zarni Wai Ag",
            "Thiha Hein",
            "Thuta Yarzar Yaza"
        ];

        for ($i=0; $i < 8; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 17;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "Soe Phone Bo",
            "Yaza Thurein",
            "Wai Nyan Zarni Zeya"
        ];

        for ($i=0; $i < 3; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 18;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "Kyaw Pyay Kaung Soe",
            "Phyo Khaing",
            "Phyo Khine Thurein",
            "Pyay Kyaw",
            "Myo Khine",
            "Bo Zeya Wunna",
            "Maung Thawda",
            "Zin Wunna Htet Zaw",
            "Zin Zin Phyo",
            "Zeya Htet Bo Thura",
            "Kyaw Thurein Min Phone",
            "Lin Thu",
            "Lin Zarni Ye",
            "Yaza Thet Arkar",
            "Htut Zarni",
            "Htun Htun Zin Thet",
            "Thet Zeya",
            "Kyaw Thurein Arkar",
            "Phone Kan Hein Aung",
            "Zeyar Kan Myat"
        ];

        for ($i=0; $i < 20; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 20;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "Zeyar Kan",
            "Kaung Zeya Zeya",
            "Pyay Arkar",
            "Zin Zarni Nyan",
            "Myat Htut Phyo Khant",
            "Bo Myint Zeyar",
            "Ko Zeyar",
            "Kaung Thu Win",
            "Wunna Thu",
            "Phyo Thu"
        ];

        for ($i=0; $i < 10; $i++) { 
            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 21;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Teacher');
            $user->syncPermissions([13,37,38,39,40,45,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        $nameLists = [
            "Phone Zeya",
            "Thu Thurein Thawda Phone",
            "Khine Aung Phyoe",
            "Kaung Thuta Thuta Htut",
            "Ko Wunna Kan",
            "Tun Zeya Thu",
            "Khant Zarni",
            "Min Myint",
            "Thu Htet",
            "Phyo Naing Tun"
        ];

        for ($i=0; $i < 10; $i++) { 

            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 22;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Staff');
            $user->syncPermissions([13,37,45,49,53,54,55,56,57,61,62,63]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }
        $nameLists = [
            "Yarzar Yaza",
            "Htet Htet Myo Kan",
            "Zaw Myint Thant Myo",
            "Yaza Myat Zeyar Naing",
            "Zaw Yaza",
            "Myo Htut",
            "Soe Wunna",
            "Arkar Thiha",
            "Min Myo",
            "Zaw Yarzar",
            "Linn Htet Tun Zarni",
            "Zeya Thurein"
        ];

        for ($i=0; $i < 12; $i++) { 

            $randomNumber1 = $faker->numberBetween(0, 29);
            $randomNumber3 = $faker->numberBetween(8, 19);

            $degrees = [ 
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)],
                $degreelists[$faker->numberBetween(0, 79)]
            ];

            $phoneno = [ 
                $faker->phoneNumber(),
                $faker->e164PhoneNumber()
            ];

            $blood = Blood::find($faker->numberBetween(1, 6));
            $religion = Religion::find($faker->numberBetween(1, 5));
            $position = 23;
            $country = Country::find($faker->numberBetween(1, 246));

            $datetimebetween = $faker->dateTimeBetween();
            $jod = date_format($datetimebetween,'Y-m-d');

            $name = $nameLists[$i];
            $email = $faker->email();

            $emailhashids = new Hashids($faker->randomNumber(5, true));
            $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

            $user = new User();
            $user->name = $name;
            $user->email = $generateEmail.'.smartcamp.com';
            $user->profile_photo_path = $profiles[$randomNumber1];
            $user->school_id = 1;
            $user->email_verified_at = $now;
            $user->password = Hash::make('123456789');
            $user->save();

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->assignRole('Staff');
            $user->syncPermissions([13,37,45,49,53,54,55,56,57,61,62,63]);

            $staff = new Staff();
            $staff->workemail = $email;
            $staff->gender = $genders[$faker->numberBetween(0, 1)];
            $staff->degree = json_encode($degrees);
            $staff->nrc = $faker->creditCardNumber();
            $staff->dob = $faker->date();
            $staff->phone = json_encode($phoneno);
            $staff->address = $faker->address();
            $staff->status = $status;
            $staff->joindate = $jod;
            $staff->file = 'storage/cv/1612455881.pdf';
            $staff->blood_id = $blood->id;
            $staff->religion_id = $religion->id;
            $staff->user_id = $user->id;
            $staff->position_id = $position;
            $staff->country_id = $country->id;
            $staff->save();

        }

        // $randomNumber1 = $faker->numberBetween(0, 29);
        // $randomNumber3 = $faker->numberBetween(8, 19);

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
        // $position = 24;
        // $country = Country::find($faker->numberBetween(1, 246));

        // $datetimebetween = $faker->dateTimeBetween();
        // $jod = date_format($datetimebetween,'Y-m-d');

        // $name = $faker->name();
        // $email = $faker->email();

        // $emailhashids = new Hashids($faker->randomNumber(5, true));
        // $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

        // $user = new User();
        // $user->name = $name;
        // $user->email = $generateEmail.'.smartcamp.com';
        // $user->profile_photo_path = $profiles[$randomNumber1];
        // $user->school_id = 1;
        // $user->email_verified_at = $now;
        // $user->password = Hash::make('123456789');
        // $user->save();

        // $verifyUser = VerifyUser::create([
        //     'user_id' => $user->id,
        //     'token' => sha1(time())
        // ]);
        // $user->assignRole('Staff');
        // $user->syncPermissions([13,37,45,49,53,54,55,56,57,61,62,63]);

        // $staff = new Staff();
        // $staff->workemail = $email;
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
        // $staff->religion_id = $religion->id;
        // $staff->user_id = $user->id;
        // $staff->position_id = $position;
        // $staff->country_id = $country->id;
        // $staff->save();

        // $randomNumber1 = $faker->numberBetween(0, 29);
        //     $randomNumber3 = $faker->numberBetween(8, 19);

        //     $degrees = [ 
        //         $degreelists[$faker->numberBetween(0, 79)],
        //         $degreelists[$faker->numberBetween(0, 79)],
        //         $degreelists[$faker->numberBetween(0, 79)]
        //     ];

        //     $phoneno = [ 
        //         $faker->phoneNumber(),
        //         $faker->e164PhoneNumber()
        //     ];

        //     $blood = Blood::find($faker->numberBetween(1, 6));
        //     $religion = Religion::find($faker->numberBetween(1, 5));
        //     $position = 25;
        //     $country = Country::find($faker->numberBetween(1, 246));

        //     $datetimebetween = $faker->dateTimeBetween();
        //     $jod = date_format($datetimebetween,'Y-m-d');

        //     $name = $faker->name();
        //     $email = $faker->email();

        //     $emailhashids = new Hashids($faker->randomNumber(5, true));
        //     $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

        //     $user = new User();
        //     $user->name = $name;
        //     $user->email = $generateEmail.'.smartcamp.com';
        //     $user->profile_photo_path = $profiles[$randomNumber1];
        //     $user->school_id = 1;
        //     $user->email_verified_at = $now;
        //     $user->password = Hash::make('123456789');
        //     $user->save();

        //     $verifyUser = VerifyUser::create([
        //         'user_id' => $user->id,
        //         'token' => sha1(time())
        //     ]);
        //     $user->assignRole('Staff');

        //     $staff = new Staff();
        //     $staff->workemail = $email;
        //     $staff->gender = $genders[$faker->numberBetween(0, 1)];
        //     $staff->degree = json_encode($degrees);
        //     $staff->nrc = $faker->creditCardNumber();
        //     $staff->dob = $faker->date();
        //     $staff->phone = json_encode($phoneno);
        //     $staff->address = $faker->address();
        //     $staff->status = $status;
        //     $staff->joindate = $jod;
        //     $staff->file = 'storage/cv/1612455881.pdf';
        //     $staff->blood_id = $blood->id;
        //     $staff->religion_id = $religion->id;
        //     $staff->user_id = $user->id;
        //     $staff->position_id = $position;
        //     $staff->country_id = $country->id;
        //     $staff->save();
        
    }



}
