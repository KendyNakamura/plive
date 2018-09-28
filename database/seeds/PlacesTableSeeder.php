<?php

use App\Http\Model\Place;
use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');

        $place1 = Place::create([
            'name' => 'Zepp Tokyo',
            'url' => 'https://hall.zepp.co.jp/tokyo/',
            'prefecture' => '東京都',
            'capacity' => 1500,
        ]);

        $place2 = Place::create([
            'name' => 'ヘブンズロック熊谷',
            'url' => 'http://www.heavensrock.com/vj1/vj1_201605.html',
            'prefecture' => '埼玉県',
            'capacity' => 300,
        ]);

        $place3 = Place::create([
            'name' => '千葉look',
            'url' => 'http://chibalook.com/',
            'prefecture' => '千葉県',
            'capacity' => 400,
        ]);

        $place4 = Place::create([
            'name' => '高崎ClubFleez',
            'url' => 'http://clubfleez.syncl.jp/',
            'prefecture' => '群馬県',
            'capacity' => 300,
        ]);

        $place5 = Place::create([
            'name' => '渋谷O-EAST',
            'url' => 'http://shibuya-o.com/',
            'prefecture' => '東京都',
            'capacity' => 1200,
        ]);
    }
}
