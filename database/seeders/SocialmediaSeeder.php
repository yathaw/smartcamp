<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Socialmedia;

class SocialmediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socialmediaLists =[

            array('/storage/socialmedia/facebook.png', 'Facebook'),
            array('/storage/socialmedia/google.png', 'Google'),
            array('/storage/socialmedia/instagram.png', 'Instagram'),
            array('/storage/socialmedia/linkedin.png', 'LinkedIn'),
            array('/storage/socialmedia/skype.png', 'Skype'),
            array('/storage/socialmedia/telegram.png', 'Telegram'),
            array('/storage/socialmedia/twitter.png', 'Twitter'),
            array('/storage/socialmedia/youtube.png', 'Youtube'),
            array('/storage/socialmedia/dribble.png', 'Dribble'),
            array('/storage/socialmedia/other.png', 'Other')
        ];
        foreach ($socialmediaLists as $socialmediaList) {
            $socialmedia = new Socialmedia;
            $socialmedia->name = $socialmediaList[1];
            $socialmedia->logo = $socialmediaList[0];
            $socialmedia->save();
        }
    }
}
