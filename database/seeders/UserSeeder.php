<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\School;
use App\Models\Permission;

use Hashids\Hashids;

use App\Models\VerifyUser;

use Illuminate\Support\Facades\Hash;
use Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $now = Carbon::now();

        $name = $faker->name();
        $emailhashids = new Hashids($name);
        $generateEmail = $emailhashids->encode(1, 2, 3); 

        $softwareadmin_user1 =User::create([
            'name' => $name,
            'email' => $generateEmail.'.smartcamp.com',
            'email_verified_at' => $now,
            'password' => Hash::make('123456789'),
        ]);

        VerifyUser::create([
            'user_id' => $softwareadmin_user1->id,
            'token' => sha1(time())
        ]);
        $softwareadmin_user1->assignRole('Software Admin');

        $schools = array(1, 'ES4E', 'storage/schoollogo/1645276457.png', '[\"storage\\/schoolcover\\/16452764571.jpg\",\"storage\\/schoolcover\\/16452764572.jpg\",\"storage\\/schoolcover\\/16452764573.jpg\",\"storage\\/schoolcover\\/16452764574.jpg\",\"storage\\/schoolcover\\/16452764575.jpg\"]', NULL, '<p style=\"padding: 0px; font-family: Roboto, sans-serif; font-size: 1.1em; text-align: justify; margin-right: 0px !important; margin-bottom: 1em !important; margin-left: 0px !important;\"><font color=\"#000000\">The foundation of child development is education. Hence it is very important that a child’s potential talents are identified before attempting to develop it successfully. ES4E prides itself with a team of professionals and academics who are experienced in identifying this potentiality and further develop it to the fullest. Each team member dedicates time and effort to ensure that personal attention is given to students to attain maximum benefit from every aspect of learning process.</font></p><p style=\"padding: 0px; font-family: Roboto, sans-serif; font-size: 1.1em; text-align: justify; margin-right: 0px !important; margin-bottom: 1em !important; margin-left: 0px !important;\"><font color=\"#000000\">Young learners learn best when they find learning is enjoyble and learning process itself is fun. We try to motivate our students by incorporating various topics that are interesting to them in the course. Our students are encouraged to take an active role in their learning since our teaching methods are interactive in nature with students being at the centre of teaching and learning processes.</font></p><p style=\"padding: 0px; font-family: Roboto, sans-serif; font-size: 1.1em; text-align: justify; margin-right: 0px !important; margin-bottom: 1em !important; margin-left: 0px !important;\"><font color=\"#000000\">We promote learning English as a living language to be used in everyday conversations. The emphasis is on active use rather than passive knowledge. By giving our students opportunities for active participation in acquiring new language skills by themselves, they are expected to be confident users of English in real-life situations.</font></p><p style=\"padding: 0px; font-family: Roboto, sans-serif; font-size: 1.1em; text-align: justify; margin-right: 0px !important; margin-bottom: 1em !important; margin-left: 0px !important;\"><font color=\"#000000\">We value learner-friendly teaching methods in the classroom, the atmosphere of which is created to be conducive to fruitful learning experience.</font></p><p style=\"padding: 0px; font-family: Roboto, sans-serif; font-size: 1.1em; text-align: justify; margin-right: 0px !important; margin-bottom: 1em !important; margin-left: 0px !important;\"><font color=\"#000000\">To realize what we value in education and life as a whole, we take a holistic approach to development of our pupils in all aspects of their education so that when they leave the school they are well prepared to meet the challenges of 21st century society.</font></p><p style=\"padding: 0px; font-family: Roboto, sans-serif; font-size: 1.1em; text-align: justify; margin-right: 0px !important; margin-bottom: 1em !important; margin-left: 0px !important;\"><font color=\"#000000\">Even then we don’t forget to provide the moral structure that young people need, through positive discipline and an emphasis on a set of universal values that includes respect for others, hard work and community spirit. We believe that these values are integral to the nurturing approach of caring and dedicated teachers who are able and willing to give the precious gift of time to the pupils in their care. With such an approach children grow as individuals and flourish, learning what it means to be human while enjoying the success that this brings.</font></p>', 'Duty, Honour, Country', '1998/01/01', NULL, 'No.51, Kaba Aye Pagoda Road, Yankin Township, Yangon, the corner of Waizayanta Road and LaydaungkanRoad ,Thingangyunn Township, Yangon , Myanmar.', '105', 29328, 2, NULL, '2022-02-04 08:36:10', '2022-02-19 06:44:17');

        $namehashids = new Hashids($schools[1]);
        $generateCodeno = $namehashids->encode(1, 2, 3); // gPUasb

        $school = new School();
        $school->codeno = $generateCodeno;
        $school->name = $schools[1];
        $school->logo = $schools[2];
        $school->coverphoto = $schools[3];
        $school->certificate = $schools[4];
        $school->about = $schools[5];
        $school->mottoes = $schools[6];
        $school->established = $schools[7];
        $school->facilities = $schools[8];
        $school->address = $schools[9];
        $school->studentamount = $schools[10];
        $school->city_id = $schools[11];
        $school->schooltype_id = 1;
        $school->save();


        $grade_schoolLists = [
            array(23, 1, 1),
            array(24, 2, 1),
            array(25, 3, 1),
            array(26, 4, 1),
            array(27, 5, 1),
            array(28, 6, 1),
            array(29, 7, 1),
            array(30, 8, 1),
            array(31, 9, 1),
            array(32, 10, 1),
            array(33, 11, 1),
            array(34, 12, 1),
            array(35, 13, 1)
        ];

        foreach($grade_schoolLists as $grade_schoolList){
            DB::table('grade_school')->insert([
                'grade_id' => $grade_schoolList[1],
                'school_id'    => $grade_schoolList[2],
            ]);
        }
    }
}
