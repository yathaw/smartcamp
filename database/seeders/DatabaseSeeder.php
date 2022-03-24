<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(BankSeeder::class);
        $this->call(SchooltypeSeeder::class);
        $this->call(ExpensetypeSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(BloodSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(GradeSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        
        $this->call(PermissionSeeder::class);

        $this->call(InterestSeeder::class);
        $this->call(SocialmediaSeeder::class);
        
    }
}
