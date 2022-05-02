<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\Expensetype;

use Faker;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $expensetype = Expensetype::find($faker->numberBetween(1, 5));

        $amounts = [10000, 20000, 30000, 40000, 50000];
        $photopath = 'storage/paymentslip/payment1.png';
        for ($i=0; $i < 70; $i++) { 
            $d = $faker->dateTimeBetween('-2 years', '-1 week');
            $d = $d->format('Y-m-d');
            // dd($d);
            $expense = new Expense();
            $expense->title = $faker->text(25);
            $expense->amount = $amounts[$faker->numberBetween(0, 4)];
            $expense->date = $d;
            $expense->photo = $photopath;
            $expense->expensetype_id = $expensetype->id;
            $expense->user_id = 2;
            $expense->school_id = 1;
            $expense->save();

        }
    }
}
