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

        factory(App\Http\Model\Artist::class, 5)->create()->each(function ($u) {
            $u->lives()->save(factory(App\Http\Model\Live::class, 5)->make());
        });

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
