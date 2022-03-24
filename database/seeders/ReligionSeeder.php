<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Religion;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $religionLists = array('Islam', 'Hindu', 'Christian', 'Buddish', 'Others');

        foreach ($religionLists as $religionList) {
            $religion = new Religion;
            $religion->name = $religionList;
            $religion->save();

        }
    }
}
