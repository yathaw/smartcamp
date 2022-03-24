<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expensetype;

class ExpensetypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expensetypeLists = array('Salary', 'Transport', 'Maintenance', 'Purchase', 'Utilities');

        foreach ($expensetypeLists as $expensetypeList) {
            $expensetype = new Expensetype;
            $expensetype->name = $expensetypeList;
            $expensetype->save();
        }
    }
}
