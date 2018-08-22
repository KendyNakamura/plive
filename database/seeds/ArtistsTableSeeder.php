<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Artist;
use App\Http\Model\Live;
use App\User;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');

        $artist1 = Artist::create([
            'name' => 'ACIDMAN',
            'url' => 'http://acidman.jp/content/liveinfo/',
            'content' => '.entry-livedate',
            'selector' => '.entry-title a',
            'image' => 'images/tama.jpg'
        ]);

        $artist2 = Artist::create([
            'name' => '10-FEET',
            'url' => 'https://10-feet.kyoto/contents/live',
            'content' => '.time',
            'selector' => '.title h3',
            'image' => 'images/tama.jpg'
        ]);

        $artist3 = Artist::create([
            'name' => '岡崎体育',
            'url' => 'https://okazakitaiiku.com/contents/live',
            'content' => '.time',
            'selector' => '.title h3',
            'image' => 'images/tama.jpg'
        ]);

        $artist4 = Artist::create([
            'name' => 'BUZZ THE BEARS',
            'url' => 'http://buzzthebears.com/news/3',
            'content' => '.topics_date',
            'selector' => '.live_title a',
            'image' => 'images/tama.jpg'
        ]);

        $artist5 = Artist::create([
            'name' => '[ALEXANDROS]',
            'url' => 'https://alexandros.jp/contents/schedule',
            'content' => '.date',
            'selector' => '.schedule a span:nth-of-type(2)',
            'image' => 'images/tama.jpg'
        ]);
    }
}
