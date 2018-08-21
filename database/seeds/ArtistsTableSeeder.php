<?php

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
        // factory(App\Http\Model\Artist::class, 5)->create('ja_JP');
        $faker = Faker\Factory::create('ja_JP');

    	for ($i = 1; $i <= 10; $i++) {
    		$artist = App\Http\Model\Artist::create([
	            'name' => $faker->name,
		        'url' => 'https://google.com',
		        'content' => 'アーティストに関する説明' . $i,
	            'image' => 'images/tama.jpg'
        	]);

            $artist->users()->attach($artist->id);
        
            for ($j = 1; $j <= 5; $j++)
            {
                App\Http\Model\Live::create([
                    'title' => $faker->name,
                    'artist_id' => $artist->id
                ]);
            }
        }
    }
}
