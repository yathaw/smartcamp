<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Package;
use App\Models\Student;
use Faker;

class InstallmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $students = Student::all();
        foreach($students as $student){
            $studentid = $student->id;

            foreach($student->studentsegments as $key => $studentsegment){
                // dd($studentsegment);
                if($studentsegment->type == "new"){
                    $sectionid = $studentsegment->batch->section->id;
                    $schoolid = 1;
                    $staffid = 2;
                    foreach($studentsegment->batch->section->packages as $key => $package){
                        $packageid = $package->id;
                        $amount = $package->amount;
                        $photopath = 'storage/paymentslip/payment1.png';
                        if($package[$key] == 0){
                            $date = $faker->dateTimeBetween('-1year 8months', '-1year 10months');
                        }
                        if($package[$key] == 1){
                            $date = $faker->dateTimeBetween('-1year 6months', '-1 year 7months');
                        }
                        if($package[$key] == 2){
                            $date = $faker->dateTimeBetween('-1year 4months', '-1year 5months');
                        }
                        if($package[$key] == 3){
                            $date = $faker->dateTimeBetween('-1year 2months', '-1year 3months');
                        }

                        $voucherno = uniqid();
                        $payment = new Payment();
                        $payment->voucherno = $voucherno;
                        $payment->amount = $amount;
                        $payment->photo = $photopath;
                        $payment->date = $date;
                        $payment->package_id = $packageid;
                        $payment->student_id = $studentid;
                        $payment->staff_id = $staffid;
                        $payment->school_id = $schoolid;
                        $payment->section_id = $sectionid;
                        $payment->save();
                    }
                }
                if($studentsegment->type == "old"){
                    $sectionid = $studentsegment->batch->section->id;
                    $schoolid = 1;
                    $staffid = 2;
                    foreach($studentsegment->batch->section->packages as $key => $package){
                        $packageid = $package->id;
                        $amount = $package->amount;
                        $photopath = 'storage/paymentslip/payment1.png';
                        if($package[$key] == 0){
                            $date = $faker->dateTimeBetween('-10months', '-8months');
                        }
                        if($package[$key] == 1){
                            $date = $faker->dateTimeBetween('-7months', '-6months');
                        }
                        if($package[$key] == 2){
                            $date = $faker->dateTimeBetween('-5months', '-4months');
                        }
                        if($package[$key] == 3){
                            $date = $faker->dateTimeBetween('-3months', '-2months');
                        }

                        $voucherno = uniqid();
                        $payment = new Payment();
                        $payment->voucherno = $voucherno;
                        $payment->amount = $amount;
                        $payment->photo = $photopath;
                        $payment->date = $date;
                        $payment->package_id = $packageid;
                        $payment->student_id = $studentid;
                        $payment->staff_id = $staffid;
                        $payment->school_id = $schoolid;
                        $payment->section_id = $sectionid;
                        $payment->save();
                    }
                }
            }
        }
        
    }
}
