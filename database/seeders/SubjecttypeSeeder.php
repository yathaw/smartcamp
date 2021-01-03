<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subjecttype;

class SubjecttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjecttypeLists = array('Main', 'Extra');

        foreach($subjecttypeLists as $subjecttypeList){
        	$subjecttype = new Subjecttype();
        	$subjecttype->name = $subjecttypeList;
        	$subjecttype->save();
        }
    }
}
