<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Artist;
use App\Http\Model\Live;

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

    	for ($i = 1; $i <= 10; $i++) {
    		Artist::create([
	            'name' => $faker->name,
		        'url' => 'https://google.com',
		        'content' => 'アーティストに関する説明' . $i,
	            'image' => 'images/tama.jpg'
        	]);

            for ($j = 1; $j <= 5; $j++)
            {
                Live::create([
                    'title' => $faker->name,
                    'artist_id' => $j
                ]);
            }
        }
    }
}
