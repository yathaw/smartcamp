<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sport;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sportLists =[

            array('/storage/sport/soccer.png', 'Soccer'),
            array('/storage/sport/basketball.png', 'Basketball'),
            array('/storage/sport/boxing.png', 'Boxing'),
            array('/storage/sport/ping-pong.png', 'Ping Pong'),
            array('/storage/sport/tennis-ball.png', 'Tennis'),
            array('/storage/sport/baseball.png', 'Baseball'),
            array('/storage/sport/golf.png', 'Golf'),
            array('/storage/sport/yoga.png', 'Yoga'),
            array('/storage/sport/chess.png', 'Chess'),
            array('/storage/sport/ballet.png', 'Ballet'),
            array('/storage/sport/hockey.png', 'Hockey'),
            array('/storage/sport/american-football.png', 'American Football'),
            array('/storage/sport/volleyball.png', 'Volleyball'),
            array('/storage/sport/yachting.png', 'Yachting'),
            array('/storage/sport/surf.png', 'Surf'),
            array('/storage/sport/darts.png', 'Darts'),
            array('/storage/sport/bowling.png', 'Bowling'),
            array('/storage/sport/cricket.png', 'Cricket'),
            array('/storage/sport/karate.png', 'Karate'),
            array('/storage/sport/archery.png', 'Archery'),
            array('/storage/sport/tactics.png', 'Tactics'),
            array('/storage/sport/hiking.png', 'Hiking'),
            array('/storage/sport/fishing.png', 'Fishing'),
            array('/storage/sport/kayak.png', 'Kayak'),
            array('/storage/sport/pool.png', 'Pool'),
            array('/storage/sport/ice-skating.png', 'Ice Skating'),
            array('/storage/sport/curling.png', 'Curling'),
            array('/storage/sport/snorking.png', 'Swimming')



        ];
        foreach ($sportLists as $sportList) {
            $sport = new Sport;
            $sport->name = $sportList[1];
            $sport->photo = $sportList[0];
            $sport->save();
        }
    }
}
