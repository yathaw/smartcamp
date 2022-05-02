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

        
        // $this->call(CountrySeeder::class);
        // $this->call(StateSeeder::class);
        // $this->call(CitySeeder::class);
        // $this->call(BankSeeder::class);
        // $this->call(SchooltypeSeeder::class);
        // $this->call(ExpensetypeSeeder::class);
        // $this->call(PlanSeeder::class);
        // $this->call(BloodSeeder::class);
        // $this->call(ReligionSeeder::class);
        // $this->call(GradeSeeder::class);

        // $this->call(RoleSeeder::class);
        
        // $this->call(PermissionSeeder::class);

        // $this->call(InterestSeeder::class);
        // $this->call(SocialmediaSeeder::class);

        // $this->call(CurrencySeeder::class);
        // $this->call(SportSeeder::class);
        
        
        // $this->call(PositionandDepartmentSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(StaffSeeder::class);

        // $this->call(SubjectSeeder::class);
        // $this->call(CurriculaSeeder::class);
        // $this->call(SyllabusSeeder::class);

        // $this->call(SubjectTeacherSeeder::class);
        // $this->call(AcademicyearSeeder::class);
        // $this->call(SectionSeeder::class);
        // $this->call(PackageSeeder::class);

        // $this->call(BatchSeeder::class);

        // $this->call(HolidaySeeder::class);
        // $this->call(TeachersegmentSeeder::class);
        
        // $this->call(ScheduleSeeder::class);


        // $this->call(StudentSeeder::class);
        // $this->call(InstallmentSeeder::class);
        // $this->call(ExamSeeder::class);
        // $this->call(AttendanceSeeder::class);
        

        // $this->call(StudentsegmentSeeder::class);

        // $this->call(ResultSeeder::class);
        
        // $this->call(ExpenseSeeder::class);
        // $this->call(PricingplanSeeder::class);
        

        // $this->call(LessonSeeder::class);
        $this->call(RecordingSeeder::class);
        
    }
}
