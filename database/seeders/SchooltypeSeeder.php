<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schooltype;

class SchooltypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schooltypeLists = array('Public', 'Private', 'Campus', 'Training');

        foreach ($schooltypeLists as $schooltypeList) {
            $schooltype = new Schooltype;
            $schooltype->name = $schooltypeList;
            $schooltype->save();
        }
    }
}
