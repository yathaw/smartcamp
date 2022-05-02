<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Holiday;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holidayLists = [

            array('New Year\'s Day', '2020-01-01'),
            array('Independence Day', '2020-01-04'),
            array('Independence Day Holiday', '2020-01-05'),
            array('Independence Day Holiday', '2020-01-06'),
            array('Union Day', '2020-02-12'),
            array('Peasants\' Day', '2020-03-02'),
            array('Full Moon Day of Tabaung Holiday', '2020-03-08'),
            array('Full Moon Day of Tabaung', '2020-03-09'),
            array('Armed Force Day', '2020-03-27'),
            array('Thingyun Water Festival', '2020-04-10'),
            array('Thingyun Water Festival', '2020-04-11'),
            array('Thingyun Water Festival', '2020-04-12'),
            array('Thingyun Water Festival', '2020-04-13'),
            array('Thingyun Water Festival', '2020-04-14'),
            array('Thingyun Water Festival', '2020-04-15'),
            array('Thingyun Water Festival', '2020-04-16'),
            array('Burmese New Year', '2020-04-17'),
            array('Burmese New Year', '2020-04-18'),
            array('Burmese New Year Holiday', '2020-04-19'),
            array('Burmese New Year', '2020-04-20'),
            array('Labour Day Day', '2020-05-01'),            
            array('Full Moon Day of Kasone', '2020-05-06'),
            array('Martyrs\' Day', '2020-07-19'),
            array('Martyrs\' Day Holiday', '2020-07-20'),
            array('Eid ul-Adha Day Holiday', '2020-07-31'),
            array('Eid ul-Adha Day', '2020-08-01'),
            array('Full Moon Day of Waso', '2020-08-03'),
            array('Thadingyut Holiday', '2020-10-29'),
            array('Pre-Full Moon Day of Thadingyut', '2020-10-30'),
            array('Full Moon Day of Thadingyut', '2020-10-31'),
            array('Post-Full Moon Day of Thadingyut', '2020-11-01'),
            array('Thadingyut Holiday', '2020-11-02'),
            array('Deepavali (in lieu)', '2020-11-13'),
            array('Deepavali', '2020-11-14'),
            array('Tazaungmone Holiday', '2020-11-27'),
            array('Tazaungmone Holiday', '2020-11-28'),
            array('Pre-Full Moon Day of Tazaungmone Holiday', '2020-11-29'),
            array('Full Moon Day of Tazaungmone', '2020-11-30'),
            array('Nation Day', '2020-12-09'),
            array('Christmas Day', '2020-12-25'),
            array('New Year Holiday', '2020-12-31'),
           

            array('New Year\'s Day', '2021-01-01'),
            array('Independence Day', '2021-01-04'),
            array('Kayin New Year Day', '2021-01-13'),
            array('Union Day', '2021-02-12'),
            array('Peasants\' Day', '2021-03-02'),
            array('Full Moon Day of Tabaung', '2021-03-26'),
            array('Full Moon Day of Tabaung', '2021-03-27'),
            array('Armed Force Day', '2021-03-27'),
            array('Armed Force Day', '2021-03-28'),
            array('Armed Force Day', '2021-03-29'),
            array('Thingyun Water Festival', '2021-04-13'),
            array('Thingyun Water Festival', '2021-04-14'),
            array('Thingyun Water Festival', '2021-04-15'),
            array('Thingyun Water Festival', '2021-04-16'),
            array('Burmese New Year', '2021-04-17'),
            array('Burmese New Year Holiday', '2021-04-18'),
            array('Burmese New Year Holiday', '2021-04-19'),
            array('Labour Day', '2021-04-30'),
            array('Labour Day', '2021-05-01'),
            array('Full Moon Day of Kasone', '2021-05-25'),
            array('Martyrs\' Day', '2021-07-19'),
            array('Public Day', '2021-07-20'),
            array('Eid ul-Adha Day', '2021-07-21'),
            array('Public Day', '2021-07-22'),
            array('Full Moon Day of Waso', '2021-07-23'),
            array('Full Moon Day of Thadingyut', '2021-10-19'),
            array('Full Moon Day of Thadingyut', '2021-10-20'),
            array('Full Moon Day of Thadingyut', '2021-10-21'),
            array('Deepavali', '2021-11-04'),
            array('Full Moon Day of Tazaungmone', '2021-11-17'),
            array('Full Moon Day of Tazaungmone', '2021-11-18'),
            array('Nation Day', '2021-11-28'),
            array('Nation Day', '2021-11-29'),
            array('Christmas Day', '2021-12-24'),
            array('Christmas Day', '2021-12-25'),
            array('New Year Holiday', '2021-12-31'),

            array('New Year\'s Day', '2022-01-01'),
            array('Kayin New Year Day', '2022-01-02'),
            array('Independence Day', '2022-01-04'),
            array('Union Day', '2022-02-12'),
            array('Peasants\' Day', '2022-03-02'),
            array('Full Moon Day of Tabaung', '2022-03-16'),
            array('Armed Force Day', '2022-03-27'),
            array('Thingyun Water Festival', '2022-04-09'),
            array('Thingyun Water Festival', '2022-04-10'),
            array('Thingyun Water Festival', '2022-04-11'),
            array('Thingyun Water Festival', '2022-04-12'),
            array('Thingyun Water Festival', '2022-04-13'),
            array('Thingyun Water Festival', '2022-04-14'),
            array('Thingyun Water Festival', '2022-04-15'),
            array('Thingyun Water Festival', '2022-04-16'),
            array('Burmese New Year', '2022-04-17'),
            array('Labour Day', '2022-05-01'),
            array('Full Moon Day of Kasone', '2022-05-14'),
            array('Eid ul-Adha Day', '2022-07-10'),
            array('Full Moon Day of Waso', '2022-07-12'),
            array('Martyrs\' Day', '2022-07-19'),
            array('Pre-Full Moon Day of Thadingyut', '2022-10-08'),
            array('Full Moon Day of Thadingyut', '2022-10-09'),
            array('Post-Full Moon Day of Thadingyut', '2022-10-10'),
            array('Deepavali', '2022-10-24'),
            array('Pre-Full Moon Day of Tazaungmone', '2022-11-06'),
            array('Full Moon Day of Tazaungmone', '2022-11-07'),
            array('Nation Day', '2022-11-17'),
            array('Kayin New Year Day', '2022-12-22'),
            array('Christmas Day', '2022-12-25'),
            array('New Year Holiday', '2022-12-31'),

            array('New Year\'s Day', '2023-01-01'),
            array('Independence Day', '2023-01-04'),
            array('Union Day', '2023-02-12'),
            array('Peasants\' Day', '2023-03-02'),
            array('Full Moon Day of Tabaung', '2023-03-06'),
            array('Armed Force Day', '2023-03-27'),
            array('Thingyun Water Festival', '2023-04-13'),
            array('Thingyun Water Festival', '2023-04-14'),
            array('Thingyun Water Festival', '2023-04-15'),
            array('Thingyun Water Festival', '2023-04-16'),
            array('Burmese New Year', '2023-04-17'),
            array('Labour Day', '2023-05-01'),
            array('Full Moon Day of Kasone', '2023-05-05'),
            array('Eid ul-Adha Day', '2023-06-29'),
            array('Martyrs\' Day', '2023-07-19'),
            array('Full Moon Day of Waso', '2023-08-02'),
            array('Full Moon Day of Thadingyut', '2023-10-28'),
            array('Full Moon Day of Thadingyut', '2023-10-29'),
            array('Post-Full Moon Day of Thadingyut', '2023-10-30'),
            array('Pre-Full Moon Day of Tazaungmone', '2023-11-06'),
            array('Full Moon Day of Tazaungmone', '2023-11-27'),
            array('Nation Day', '2023-11-18'),
            array('Christmas Day', '2023-12-25'),
            array('New Year Holiday', '2023-12-31')
        ];

        foreach ($holidayLists as $holidayList) {
            $holiday = new Holiday;
            $holiday->name = $holidayList[0];
            $holiday->date = $holidayList[1];
            $holiday->user_id = 2;
            $holiday->school_id = 1;

            $holiday->save();

        }
    }
}
