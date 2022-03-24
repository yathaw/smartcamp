<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interest;

class InterestSeeder extends Seeder
{
    public function run()
    {
        $interestLists = array('Adminssions / Registration / Enrollment', 'Assignments / Homework', 'Attendnace', 'Billing / Fees', 'Gradebooks / Report Cards / Transcripts', 'Learning Management System', 'Lesson Plans', 'Lunch Count', 'Master Scheduler', 'Parent Portal / Student Portal','Scheduler');

        foreach ($interestLists as $interestList) {
            $grade = new Interest;
            $grade->name = $interestList;
            $grade->save();

        }
    }
}
