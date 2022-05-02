<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;
use Faker;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $batchLists = [
            // array('KG-001', 'Avocado', '#568203', '#cbf0f5', 1, NULL),
            // array('KG-002', 'Grape', '#6f2da8', '#d1d1dc', 1, NULL),
            // array('KG-003', 'Apple', '#66b447', '#9a1006', 1, NULL),
            // array('KG-004', 'Pineapple', '#ffff65', '#787b4e', 1, NULL),
            // array('KG-005', 'Mango', '#f4bb44', '#c9342f', 1, NULL),
            // array('KG-006', 'Pear', '#d1e231', '#204d48', 1, NULL),
            // array('G1-001', 'Star Flower', '#acb9ca', '#b30b67', 2, NULL),
            // array('G1-002', 'Tiger Lady', '#db8780', '#8d0922', 2, NULL),
            // array('G1-003', 'Gumkino', '#feb310', '#036967', 2, NULL),
            // array('G1-004', 'Rose', '#f33a6a', '#f2b1b8', 2, NULL),
            // array('G1-005', 'Cherry', '#d2042d', '#abcdd8', 2, NULL),
            // array('G1-006', 'Jasmine', '#f8de7e', '#cb4c50', 2, NULL),
            // array('G1-007', 'Mesua', '#f8de7e', '#14574d', 2, NULL),
            // array('G2-001', 'Pearl', '#eae0c8', '#3f296b', 3, NULL),
            // array('G2-002', 'Sapphire', '#0f52ba', '#b7d5da', 3, NULL),
            // array('G2-003', 'Ruby', '#e0115f', '#f0b8cc', 3, NULL),
            // array('G2-004', 'Emerald', '#50c878', '#2a1793', 3, NULL),
            // array('G3-001', 'Iron Man', '#4b0908', '#ccf66a', 4, NULL),
            // array('G3-002', 'Hulk', '#9bc063', '#105364', 4, NULL),
            // array('G3-003', 'Thor', '#2c3034', '#c9cfe6', 4, NULL),
            // array('G3-004', 'Captain America', '#000042', '#d91714', 4, NULL),
            // array('G3-005', 'Ant-man', '#9d152c', '#c5e8fa', 4, NULL),
            // array('G4-001', 'Sun', '#f9d71c', '#b91a74', 5, NULL),
            // array('G4-002', 'Earth', '#806043', '#d5d7de', 5, NULL),
            // array('G4-003', 'Moon', '#fefcd7', '#897245', 5, NULL),
            // array('G5-001', 'Mount Popa', '#389b9e', '#faa30c', 6, NULL),
            // array('G5-002', 'Mount Zwegabin', '#9bdaff', '#8d37f0', 6, NULL),
            // array('G5-003', 'Mount Victoria', '#33aedf', '#c3ecf6', 6, NULL),
            // array('G6-001', 'U Phoe Kyar', '#1c5763', '#f4bcc4', 7, NULL),
            // array('G6-002', 'Min Thu Wun', '#452f34', '#c5cdd9', 7, NULL),
            // array('G7-001', 'Innwa', '#ebc5fe', '#1b156a', 8, NULL),
            // array('G7-002', 'Bagan', '#a870b6', '#ddcfeb', 8, NULL),
            // array('G8-001', 'Tabinshwehti', '#eacdca', '#ba220d', 9, NULL),
            // array('G8-002', 'Smin Bayan', '#d891b5', '#ac1663', 9, NULL),
            // array('G9-001', 'Chindwin River', '#68daaf', '#18533f', 10, NULL),
            // array('G9-002', 'Sittaung River', '#9d1ca9', '#cba1fb', 10, NULL),
            // array('G9-003', 'Mekha River', '#225d99', '#c5ccd2', 10, NULL),
            // array('G10-001', 'Bo La Raung', '#6d81be', '#d5d4e1', 11, NULL),
            // array('G10-002', 'Bo Yan Aung', '#a16691', '#b6cbc6', 11, NULL),
            // array('G10-001', 'Mercury', '#9dbef1', '#b12d1f', 12, $faker->numberBetween(1, 4)),
            // array('G10-002', 'Venus', '#b8c69b', '#a03774', 12, $faker->numberBetween(1, 4)),
            // array('G10-001', 'Mars', '#485d4e', '#99d2e5', 12, $faker->numberBetween(1, 4)),
            // array('G10-002', 'Jupiter', '#cbf159', '#1f2572', 12, $faker->numberBetween(1, 4)),
            // array('G10-001', 'Scorpio', '#f6d1df', '#d71649', 13, $faker->numberBetween(1, 4)),
            // array('G10-002', 'Aries', '#5ca7e8', '#ceebf5', 13, $faker->numberBetween(1, 4)),
            // array('G10-001', 'Cancer', '#448647', '#94fe7e', 13, $faker->numberBetween(1, 4)),
            // array('G10-002', 'Leo', '#53338f', '#c8cbdf', 13, $faker->numberBetween(1, 4)),

            array('KG-001', 'Avocado', '#568203', '#cbf0f5', 14, NULL),
            array('KG-002', 'Grape', '#6f2da8', '#d1d1dc', 14, NULL),
            array('KG-003', 'Apple', '#66b447', '#9a1006', 14, NULL),
            array('KG-004', 'Pineapple', '#ffff65', '#787b4e', 14, NULL),
            array('KG-005', 'Mango', '#f4bb44', '#c9342f', 14, NULL),
            array('KG-006', 'Pear', '#d1e231', '#204d48', 14, NULL),
            array('G1-001', 'Star Flower', '#acb9ca', '#b30b67', 15, NULL),
            array('G1-002', 'Tiger Lady', '#db8780', '#8d0922', 15, NULL),
            array('G1-003', 'Gumkino', '#feb310', '#036967', 15, NULL),
            array('G1-004', 'Rose', '#f33a6a', '#f2b1b8', 15, NULL),
            array('G1-005', 'Cherry', '#d2042d', '#abcdd8', 15, NULL),
            array('G1-006', 'Jasmine', '#f8de7e', '#cb4c50', 15, NULL),
            array('G1-007', 'Mesua', '#f8de7e', '#14574d', 15, NULL),
            array('G2-001', 'Pearl', '#eae0c8', '#3f296b', 16, NULL),
            array('G2-002', 'Sapphire', '#0f52ba', '#b7d5da', 16, NULL),
            array('G2-003', 'Ruby', '#e0115f', '#f0b8cc', 16, NULL),
            array('G2-004', 'Emerald', '#50c878', '#2a1793', 16, NULL),
            array('G3-001', 'Iron Man', '#4b0908', '#ccf66a', 17, NULL),
            array('G3-002', 'Hulk', '#9bc063', '#105364', 17, NULL),
            array('G3-003', 'Thor', '#2c3034', '#c9cfe6', 17, NULL),
            array('G3-004', 'Captain America', '#000042', '#d91714', 17, NULL),
            array('G3-005', 'Ant-man', '#9d152c', '#c5e8fa', 17, NULL),
            array('G4-001', 'Sun', '#f9d71c', '#b91a74', 18, NULL),
            array('G4-002', 'Earth', '#806043', '#d5d7de', 18, NULL),
            array('G4-003', 'Moon', '#fefcd7', '#897245', 18, NULL),
            array('G5-001', 'Mount Popa', '#389b9e', '#faa30c', 19, NULL),
            array('G5-002', 'Mount Zwegabin', '#9bdaff', '#8d37f0', 19, NULL),
            array('G5-003', 'Mount Victoria', '#33aedf', '#c3ecf6', 19, NULL),
            array('G6-001', 'U Phoe Kyar', '#1c5763', '#f4bcc4', 20, NULL),
            array('G6-002', 'Min Thu Wun', '#452f34', '#c5cdd9', 20, NULL),
            array('G7-001', 'Innwa', '#ebc5fe', '#1b156a', 21, NULL),
            array('G7-002', 'Bagan', '#a870b6', '#ddcfeb', 21, NULL),
            array('G8-001', 'Tabinshwehti', '#eacdca', '#ba220d', 22, NULL),
            array('G8-002', 'Smin Bayan', '#d891b5', '#ac1663', 22, NULL),
            array('G9-001', 'Chindwin River', '#68daaf', '#18533f', 23, NULL),
            array('G9-002', 'Sittaung River', '#9d1ca9', '#cba1fb', 23, NULL),
            array('G9-003', 'Mekha River', '#225d99', '#c5ccd2', 23, NULL),
            array('G10-001', 'Bo La Raung', '#6d81be', '#d5d4e1', 24, NULL),
            array('G10-002', 'Bo Yan Aung', '#a16691', '#b6cbc6', 24, NULL),
            array('G10-001', 'Mercury', '#9dbef1', '#b12d1f', 25, $faker->numberBetween(1, 4)),
            array('G10-002', 'Venus', '#b8c69b', '#a03774', 25, $faker->numberBetween(1, 4)),
            array('G10-001', 'Mars', '#485d4e', '#99d2e5', 25, $faker->numberBetween(1, 4)),
            array('G10-002', 'Jupiter', '#cbf159', '#1f2572', 25, $faker->numberBetween(1, 4)),
            array('G10-001', 'Scorpio', '#f6d1df', '#d71649', 26, $faker->numberBetween(1, 4)),
            array('G10-002', 'Aries', '#5ca7e8', '#ceebf5', 26, $faker->numberBetween(1, 4)),
            array('G10-001', 'Cancer', '#448647', '#94fe7e', 26, $faker->numberBetween(1, 4)),
            array('G10-002', 'Leo', '#53338f', '#c8cbdf', 26, $faker->numberBetween(1, 4)),

            // array('KG-001', 'Avocado', '#568203', '#cbf0f5', 27),
            // array('KG-002', 'Grape', '#6f2da8', '#d1d1dc', 27),
            // array('KG-003', 'Apple', '#66b447', '#9a1006', 27),
            // array('KG-004', 'Pineapple', '#ffff65', '#787b4e', 27),
            // array('KG-005', 'Mango', '#f4bb44', '#c9342f', 27),
            // array('KG-006', 'Pear', '#d1e231', '#204d48', 27),
            // array('G1-001', 'Star Flower', '#acb9ca', '#b30b67', 28),
            // array('G1-002', 'Tiger Lady', '#db8780', '#8d0922', 28),
            // array('G1-003', 'Gumkino', '#feb310', '#036967', 28),
            // array('G1-004', 'Rose', '#f33a6a', '#f2b1b8', 28),
            // array('G1-005', 'Cherry', '#d2042d', '#abcdd8', 28),
            // array('G1-006', 'Jasmine', '#f8de7e', '#cb4c50', 28),
            // array('G1-007', 'Mesua', '#f8de7e', '#14574d', 28),
            // array('G2-001', 'Pearl', '#eae0c8', '#3f296b', 29),
            // array('G2-002', 'Sapphire', '#0f52ba', '#b7d5da', 29),
            // array('G2-003', 'Ruby', '#e0115f', '#f0b8cc', 29),
            // array('G2-004', 'Emerald', '#50c878', '#2a1793', 29),
            // array('G3-001', 'Iron Man', '#4b0908', '#ccf66a', 30),
            // array('G3-002', 'Hulk', '#9bc063', '#105364', 30),
            // array('G3-003', 'Thor', '#2c3034', '#c9cfe6', 30),
            // array('G3-004', 'Captain America', '#000042', '#d91714', 30),
            // array('G3-005', 'Ant-man', '#9d152c', '#c5e8fa', 30),
            // array('G4-001', 'Sun', '#f9d71c', '#b91a74', 31),
            // array('G4-002', 'Earth', '#806043', '#d5d7de', 31),
            // array('G4-003', 'Moon', '#fefcd7', '#897245', 31),
            // array('G5-001', 'Mount Popa', '#389b9e', '#faa30c', 32),
            // array('G5-002', 'Mount Zwegabin', '#9bdaff', '#8d37f0', 32),
            // array('G5-003', 'Mount Victoria', '#33aedf', '#c3ecf6', 32),
            // array('G6-001', 'U Phoe Kyar', '#1c5763', '#f4bcc4', 33),
            // array('G6-002', 'Min Thu Wun', '#452f34', '#c5cdd9', 33),
            // array('G7-001', 'Innwa', '#ebc5fe', '#1b156a', 34),
            // array('G7-002', 'Bagan', '#a870b6', '#ddcfeb', 34),
            // array('G8-001', 'Tabinshwehti', '#eacdca', '#ba220d', 35),
            // array('G8-002', 'Smin Bayan', '#d891b5', '#ac1663', 35),
            // array('G9-001', 'Chindwin River', '#68daaf', '#18533f', 36),
            // array('G9-002', 'Sittaung River', '#9d1ca9', '#cba1fb', 36),
            // array('G9-003', 'Mekha River', '#225d99', '#c5ccd2', 36),
            // array('G10-001', 'Bo La Raung', '#6d81be', '#d5d4e1', 37),
            // array('G10-002', 'Bo Yan Aung', '#a16691', '#b6cbc6', 37),
            // array('G10-001', 'Mercury', '#9dbef1', '#b12d1f', 38),
            // array('G10-002', 'Venus', '#b8c69b', '#a03774', 38),
            // array('G10-001', 'Mars', '#485d4e', '#99d2e5', 38),
            // array('G10-002', 'Jupiter', '#cbf159', '#1f2572', 38),
            // array('G10-001', 'Scorpio', '#f6d1df', '#d71649', 39),
            // array('G10-002', 'Aries', '#5ca7e8', '#ceebf5', 39),
            // array('G10-001', 'Cancer', '#448647', '#94fe7e', 39),
            // array('G10-002', 'Leo', '#53338f', '#c8cbdf', 39)


        ];

        foreach ($batchLists as $batchList) {
            $batch = new Batch;
            $batch->codeno = $batchList[0];
            $batch->name = $batchList[1];
            $batch->bgcolor = $batchList[2];
            $batch->txtcolor = $batchList[3];
            $batch->subjecttype_id = $batchList[5];
            $batch->section_id = $batchList[4];
            $batch->user_id = 2;
            $batch->school_id = 1;
            $batch->save();
        }
    }
}
