<?php

use App\Http\Model\Artist;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
            'selector' => '.entry-post',
            'title_selector' => '.entry-title a',
            'date_selector' => '.entry-livedate',
            'image' => 'images/tama.jpg'
        ]);

        $artist2 = Artist::create([
            'name' => '10-FEET',
            'url' => 'https://10-feet.kyoto/contents/live',
            'selector' => '.content-list li',
            'title_selector' => '.title h3',
            'date_selector' => '.time',
            'image' => 'images/tama.jpg'
        ]);

        $artist3 = Artist::create([
            'name' => '岡崎体育',
            'url' => 'https://okazakitaiiku.com/contents/live',
            'selector' => '.content-list li',
            'title_selector' => '.title h3',
            'date_selector' => '.time',
            'image' => 'images/tama.jpg'
        ]);

        $artist5 = Artist::create([
            'name' => '[ALEXANDROS]',
            'url' => 'https://alexandros.jp/contents/schedule',
            'selector' => '.schedule a',
            'title_selector' => 'span:nth-of-type(2)',
            'date_selector' => '.date',
            'image' => 'images/tama.jpg'
        ]);

        $artist1->users()->attach($artist1->id);
        $artist2->users()->attach($artist2->id);
        $artist3->users()->attach($artist3->id);
        $artist5->users()->attach($artist5->id);
    }
}
